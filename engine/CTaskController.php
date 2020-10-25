<?php
require_once "CSQLManager.php";
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
class CTaskController
{

    private $m_iUserID, $m_iTaskID;

    public function __construct( int $m_iUserID, int $m_iTaskID )
    {
        global $g_pSQLManager;

        $this->sql = $g_pSQLManager;
        $this->m_iUserID = $m_iUserID;
        $this->m_iTaskID = $m_iTaskID;
    }

    public function IsValid( )
    {
        $tests = $this->sql->GetData("SELECT target FROM tests WHERE id = ?", [$this->m_iTaskID]);
        $data = $this->sql->GetData("SELECT * FROM results WHERE user_id = ? AND test_id = ?", [$this->m_iUserID, $this->m_iTaskID]);
        $user = $this->sql->GetData("SELECT * FROM users WHERE id = ?", [$this->m_iUserID])[0];

        if( count( $tests ) != 1 || !empty($data) || $user['unique_group'] != $tests[0]['target'] )
            return false;
        return true;
    }

    public function GetTasks( )
    {
        $tests = $this->sql->GetData("SELECT * FROM tests WHERE id = ?", [$this->m_iTaskID])[0];
        $content = json_decode($tests['content'], 1);
        $m_aTasks = array( );

        foreach($content as $val) {
            if ( !is_array( $val ) )
                continue;

           $m_aTasks[ ][ "context" ] = $val[ "context" ];
        }
        return $m_aTasks;
    }

    public function SendTask( Array $data )
    {
        $test = $this->sql->GetData("SELECT * FROM tests WHERE id = ?", [$this->m_iTaskID])[0];
        $answers = json_decode($test['content'], 1);

        $procent = 100 / count($answers);
        $procents = 0;

        foreach ($answers as $key => $arr) {
            $key += 1;
            if (isset($data[$key]) && $data[$key] == $arr['answer']) {
                $procents += $procent;
            }
        }
        $m_iPercentage = round($procents, 100);
        $mark = round($m_iPercentage / 20, 0);
        $this->sql->UpdateData("INSERT INTO results (user_id, test_id, mark) VALUES (?, ?, ?)",
        [
            $this->m_iUserID, $this->m_iTaskID, $mark
        ]);
        return $m_iPercentage;
    }
}