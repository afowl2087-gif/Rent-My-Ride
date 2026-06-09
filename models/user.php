<?php

require_once ROOT . '/config/database.php';

class User
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = getDB();
    }

    // GET ALL
   public function getAll()
{
    $stmt = $this->pdo->query("
        SELECT * 
        FROM users 
        WHERE is_archived = 0
        ORDER BY nom, prenom
    ");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    public function findByEmail($email)
{
    $stmt = $this->pdo->prepare(
        "SELECT * FROM users WHERE email = :email LIMIT 1"
    );

    $stmt->execute([
        'email' => $email
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
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

    // ARCHIVE
    public function archive($id)
{
    $stmt = $this->pdo->prepare("
        UPDATE users
        SET is_archived = 1
        WHERE Id_users = :id
    ");

    return $stmt->execute(['id' => $id]);
}

public function getArchived()
{
    $stmt = $this->pdo->query("
        SELECT * 
        FROM users 
        WHERE is_archived = 1 
        ORDER BY nom, prenom
    ");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function restore($id)
{
    $stmt = $this->pdo->prepare("
        UPDATE users
        SET is_archived = 0
        WHERE Id_users = :id
    ");

    return $stmt->execute(['id' => $id]);
}
}
