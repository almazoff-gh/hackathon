<?php

require_once $_SERVER[ "DOCUMENT_ROOT" ] . "/engine/UserManager.php";

class CTaskManager
{

    private $m_UserData;
    private $m_pDB;

    public function __construct( int $m_iSessionID )
    {
        global $g_pSQLManager;

        $m_pUser = new UserManager( );

        $this->m_UserData = $m_pUser->GetByID( $m_iSessionID );
        $this->m_pDB = $g_pSQLManager;
    }

    public function HasPermission( )
    {
        return ( $this->m_UserData[ "permission" ] >= 1 );
    }

    public function GetSchoolList( )
    {
        return $this->m_pDB->GetData( "SELECT id, school FROM schools", array( ) );
    }

    public function CreateTest( array $m_aTestData )
    {
        $m_sTarget = $m_aTestData[ "school" ] . "_" . $m_aTestData[ "class_number" ] . $m_aTestData[ "class_letter" ];

        $m_aContent = array( );
        $m_iCurrent = -1;

        foreach ( $m_aTestData as $m_Key => $m_Value )
        {
            $m_aData = explode( "_", $m_Key );
            if ( count( $m_aData ) != 2 )
                continue;

            if ( $m_aData[ 0 ] == "question" )
            {
                $m_aContent[ ] = array( "context" => $m_Value, "answer" => "" );
                $m_iCurrent++;
            }
            elseif ( $m_aData[ 0 ] == "answer" )
                $m_aContent[ $m_iCurrent ][ "answer" ] = $m_Value;
        }

        $m_sRecord = json_encode( $m_aContent );

        $this->m_pDB->UpdateData
        (
            "INSERT INTO tests ( target, content, owner, test_name ) VALUES ( ?, ?, ?, ? )",
            array( $m_sTarget, $m_sRecord, htmlspecialchars( $m_aTestData[ "owner" ] ), $m_aTestData[ "test_name" ] )
        );
    }

    public function RemoveTest( int $m_iTestID )
    {
        $m_aData = $this->m_pDB->GetData( "SELECT owner FROM tests WHERE id = ?", array( $m_iTestID ) );
        if ( count( $m_aData ) != 1 )
            return;

        if ( $m_aData[ 0 ][ "owner" ] != $this->m_UserData[ "id" ] )
            return;

        $this->m_pDB->UpdateData
        (
            "DELETE FROM tests WHERE id = ?",
            array( $m_iTestID )
        );
    }

}