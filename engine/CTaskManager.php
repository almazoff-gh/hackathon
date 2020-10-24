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
        return ( $this->m_UserData[ "permission" ] == 1 );
    }

    public function GetSchoolList( )
    {
        return $this->m_pDB->GetData( "SELECT id, school FROM schools", array( ) );
    }

    public function CreateTest( array $m_aTestData )
    {
        $m_sTarget = $m_aTestData[ "school" ] . "_" . $m_aTestData[ "class_number" ] . $m_aTestData[ "class_letter" ];
        $m_sRecord = json_encode( $m_aTestData[ "test" ] );



        for ( $i = 3; $i < count( $m_aTestData ); $i++ )
        {

        }

        $this->m_pDB->UpdateData
        (
            "INSERT INTO tests ( target, content ) VALUES ( ?, ? )",
            array( $m_sTarget, $m_sRecord )
        );
    }

    public function MakeRoutine( )
    {

    }

}