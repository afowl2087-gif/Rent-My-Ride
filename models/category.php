<?php

require_once __DIR__ . '/../config/database.php';

class Category
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll(): array
    {
        return $this->pdo->query("SELECT * FROM categories ORDER BY nom_categorie")->fetchAll();
    }

    public function findById(int $id): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE Id_categories = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function insert(string $nom): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO categories (nom_categorie) VALUES (:nom)");
        return $stmt->execute(['nom' => $nom]);
    }

    public function update(int $id, string $nom): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE categories SET nom_categorie = :nom WHERE Id_categories = :id"
        );
        return $stmt->execute(['id' => $id, 'nom' => $nom]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE Id_categories = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Vérifie si un nom existe déjà, en excluant optionnellement un id (pour le update).
     */
    public function isExist(string $nom, ?int $excludeId = null): bool
    {
        if ($excludeId !== null) {
            $stmt = $this->pdo->prepare(
                "SELECT Id_categories FROM categories
                 WHERE nom_categorie = :nom AND Id_categories != :id"
            );
            $stmt->execute(['nom' => $nom, 'id' => $excludeId]);
        } else {
            $stmt = $this->pdo->prepare(
                "SELECT Id_categories FROM categories WHERE nom_categorie = :nom"
            );
            $stmt->execute(['nom' => $nom]);
        }
        return $stmt->rowCount() > 0;
    }
}
