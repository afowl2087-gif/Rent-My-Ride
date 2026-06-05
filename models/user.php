<?php

require_once __DIR__ . '/../config/database.php';

class User
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    // GET ALL
    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM users ORDER BY nom, prenom");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // FIND BY ID
    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE Id_users = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // EMAIL EXIST (évite les doublons)
    public function emailExists($email, $excludeId = null)
    {
        if ($excludeId !== null) {
            $stmt = $this->pdo->prepare(
                "SELECT Id_users FROM users WHERE email = :email AND Id_users != :id"
            );
            $stmt->execute(['email' => $email, 'id' => $excludeId]);
        } else {
            $stmt = $this->pdo->prepare("SELECT Id_users FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
        }
        return $stmt->rowCount() > 0;
    }

    // INSERT — retourne le nouvel id
    public function insert($nom, $prenom, $email, $telephone, $mot_de_passe = '', $role = 0)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (nom, prenom, email, telephone, mot_de_passe, role)
             VALUES (:nom, :prenom, :email, :tel, :mdp, :role)"
        );
        $stmt->execute([
            'nom'    => $nom,
            'prenom' => $prenom,
            'email'  => $email,
            'tel'    => $telephone,
            'mdp'    => $mot_de_passe,
            'role'   => $role,
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    // UPDATE
    public function update($id, $nom, $prenom, $email, $telephone, $role)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE users SET nom=:nom, prenom=:prenom, email=:email,
             telephone=:tel, role=:role WHERE Id_users=:id"
        );
        return $stmt->execute([
            'id'     => $id,
            'nom'    => $nom,
            'prenom' => $prenom,
            'email'  => $email,
            'tel'    => $telephone,
            'role'   => $role,
        ]);
    }

    // DELETE
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE Id_users = :id");
        return $stmt->execute(['id' => $id]);
    }
}