<?php
require_once "CSQLManager.php";

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
        return true;
    }

    public function GetTasks( )
    {
        $m_aTasks = array
        (
            array
            (
                "context" => "Однажды дед насрал в коляску. Сколько говна в коляске?"
            ),
            array(
                "context" => "Какое размер очка?"
            )
        );

        // function routine

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