<?php

require_once $_SERVER[ "DOCUMENT_ROOT" ] . "/config.php";

$g_pSQLManager = new CSQLManager( );

class CSQLManager
{

    private $m_aData = array( );

    public function __construct( )
    {
        global $g_aSettings;

        $this->m_aData[ "host" ] = $g_aSettings[ "db" ][ "host" ];
        $this->m_aData[ "user" ] = $g_aSettings[ "db" ][ "username" ];
        $this->m_aData[ "pass" ] = $g_aSettings[ "db" ][ "password" ];
        $this->m_aData[ "dbname" ] = $g_aSettings[ "db" ][ "dbname" ];
    }

    private function Connect( )
    {
        $dsn = "mysql:host={$this->m_aData[ "host" ]};dbname={$this->m_aData[ "dbname" ]};charset=utf8";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        return new PDO( $dsn, $this->m_aData[ "user" ], $this->m_aData[ "pass" ], $opt );
    }

    public function UpdateData( String $m_sSql, array $m_aArgs )
    {
        $m_Stmt = $this->Connect( )->prepare( $m_sSql );
        $m_Stmt->execute( $m_aArgs );
        return $m_Stmt;
    }

    public function GetData( String $m_sSql, array $m_aArgs )
    {
        return $this->UpdateData( $m_sSql, $m_aArgs )->fetchAll( );
    }

}