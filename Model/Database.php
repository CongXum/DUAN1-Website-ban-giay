<?php

class Database
{
    private $dbhost = "onehost-wphn092505.000nethost.com";
    private $dbuser = "iblmvelyhosting_DuAn1_backend";
    private $dbname = "iblmvelyhosting_DuAn1";
    private $dbpass = "6gZoP`M-yC73u*Q";
    public $dbconnection;

    public function connect()
    {
        try {
            $this->dbconnection = new PDO(
                "mysql:host={$this->dbhost};dbname={$this->dbname};charset=utf8",
                $this->dbuser,
                $this->dbpass,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
            return $this->dbconnection;
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }
}
