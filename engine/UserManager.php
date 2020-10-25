<?php

require_once "CSQLManager.php";

class UserManager
{

    private $sql;

    public function __construct() {
        global $g_pSQLManager;
        $this->sql = $g_pSQLManager;
    }

    public function Exist(String $username) {
        $data = $this->sql->GetData("SELECT * FROM users WHERE username = ?", [$username]);
        return ( count( $data ) == 1 );
    }

    public function Get(String $username) {
        $data = $this->sql->GetData("SELECT * FROM users WHERE username = ?", [$username]);
        return $data[0];
    }

    public function GetByID(String $id) {
        $data = $this->sql->GetData("SELECT * FROM users WHERE id = ?", [$id]);
        return $data[0];
    }

    public function VerifyPassword(String $password, String $hash) {
        if(!password_verify(md5($password), $hash))
            return false;
        return true;
    }

    public function Create(String $username, String $password, String $name, String $unique_group, Int $permission=0) {
        $this->sql->UpdateData(
            "INSERT INTO users (username, password, unique_group, permission, display_name) VALUES (?, ?, ?, ?, ?);",
            [ $username, password_hash(md5($password), PASSWORD_DEFAULT), $unique_group, $permission, $name ]
        );
    }

    public function CreateSchool(String $school, String $director) {
        $this->sql->UpdateData("INSERT INTO schools (school, director) VALUE (?, ?)", [ $school, $director ]);
    }

    public function EditGroup(String $username, String $group) {
        $this->sql->UpdateData("UPDATE users SET unique_group = ? WHERE username = ?;",
            [$group, $username]
        );
    }

    public function GetSchool(String $school) {
        return $this->sql->GetData("SELECT * FROM schools WHERE school = ?", [$school])[0];
    }

    public function GetSchoolByDir(String $director) {
        return $this->sql->GetData("SELECT * FROM schools WHERE director = ?", [$director])[0];
    }

    public function GetAvailableTests( $m_iUID )
    {
        $m_aData = $this->sql->GetData( "SELECT unique_group FROM users WHERE id = ?", array( $m_iUID ) );
        if ( count( $m_aData ) != 1 )
            return array( );

        $m_aTasks = $this->sql->GetData( "SELECT tests.id, tests.test_name FROM tests WHERE target = ?",
            array( $m_aData[ 0 ][ "unique_group" ] ) );

        $m_aSolvedTests = $this->sql->GetData( "SELECT test_id FROM results WHERE user_id = ?",
            array( $m_iUID ) );

        $m_aResult = array( );
        foreach ( $m_aTasks as $m_aTask )
        {
            $m_bContinue = true;

            foreach ( $m_aSolvedTests as $m_aSolvedTest )
            {
                if ( $m_aTask[ "id" ] == $m_aSolvedTest[ "test_id" ] )
                {
                    $m_bContinue = false;
                    break;
                }
            }

            if ( !$m_bContinue )
                continue;

            $m_aResult[ ] = $m_aTask;
        }

        return $m_aResult;
    }

    public function GetModifableTests( int $m_iUID )
    {
        return $this->sql->GetData( "SELECT id, test_name FROM tests WHERE owner=?", array( $m_iUID ) );
    }

    public function getSchools() {
        return $this->sql->GetData("SELECT * FROM schools", []);
    }
}