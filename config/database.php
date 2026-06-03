<?php

class Database
{
    private $host = "localhost";
    private $db_name = "location_vehicules";
    private $username = "root";
    private $password = "";

    public $pdo;

    public function getConnection()
    {
        $this->pdo = null;

        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Erreur connexion DB : " . $e->getMessage());
        }

        return $this->pdo;
    }
}