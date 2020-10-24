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

    public function VerifyPassword(String $username, String $password) {
        $user = $this->Get($username);
        if(!password_verify(md5($password), $user['password']))
            return false;
        return true;
    }

    public function Create(String $username, String $password, Int $school, Int $unique_group, Int $permission=0) {
        $this->sql->UpdateData(
            "INSERT INTO users (username, password, school, unique_group, permission) VALUES (?, ?, ?, ?, ?);",
            [ $username, password_hash(md5($password), PASSWORD_DEFAULT), $school, $unique_group, $permission ]
        );
    }

}