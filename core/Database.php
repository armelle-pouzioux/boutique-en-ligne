<?php

class Database{
    protected $pdo;

    public function __construct($host = "localhost", $dbname = "boutique_en_ligne", $user = "root", $password = "")
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }
}