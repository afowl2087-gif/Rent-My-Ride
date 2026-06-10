<?php

class Database
{
    private string $host     = 'localhost';
    private string $db_name  = 'rentmyride';
    private string $username = 'root';
    private string $password = '';

    public function getConnection(): PDO
    {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE,        PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            die('Erreur connexion DB : ' . $e->getMessage());
        }
    }
}
