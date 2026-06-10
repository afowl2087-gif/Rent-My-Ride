<?php

require_once __DIR__ . '/../config/database.php';

class User
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll(): array
    {
        return $this->pdo->query("SELECT * FROM users ORDER BY nom, prenom")->fetchAll();
    }

    public function findById(int $id): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE Id_users = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function emailExists(string $email, ?int $excludeId = null): bool
    {
        if ($excludeId !== null) {
            $stmt = $this->pdo->prepare(
                "SELECT Id_users FROM users WHERE email = :email AND Id_users != :id"
            );
            $stmt->execute(['email' => $email, 'id' => $excludeId]);
        } else {
            $stmt = $this->pdo->prepare(
                "SELECT Id_users FROM users WHERE email = :email"
            );
            $stmt->execute(['email' => $email]);
        }
        return $stmt->rowCount() > 0;
    }

    public function insert(
        string $nom,
        string $prenom,
        string $email,
        string $telephone,
        string $mot_de_passe = '',
        int    $role = 0
    ): int {
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

    public function update(
        int    $id,
        string $nom,
        string $prenom,
        string $email,
        string $telephone,
        int    $role
    ): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE users
             SET nom=:nom, prenom=:prenom, email=:email, telephone=:tel, role=:role
             WHERE Id_users=:id"
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

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE Id_users = :id");
        return $stmt->execute(['id' => $id]);
    }
}
