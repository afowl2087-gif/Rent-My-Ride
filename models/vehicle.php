<?php

require_once __DIR__ . '/../config/database.php';

class Vehicle
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll(): array
    {
        return $this->pdo->query(
            "SELECT v.*, c.nom_categorie
             FROM vehicules v
             LEFT JOIN categories c ON c.Id_categories = v.Id_categories
             ORDER BY c.nom_categorie, v.marque, v.model"
        )->fetchAll();
    }

    public function getAllAvailable(
        ?int    $catId   = null,
        ?string $search  = null,
        int     $page    = 1,
        int     $perPage = 10
    ): array {
        $where  = ['v.disponibilite = 1'];
        $params = [];

        if ($catId) {
            $where[]          = 'v.Id_categories = :cat_id';
            $params['cat_id'] = $catId;
        }
        if ($search) {
            $where[]     = '(v.marque LIKE :s OR v.model LIKE :s OR v.description LIKE :s OR v.nom LIKE :s)';
            $params['s'] = '%' . $search . '%';
        }

        $offset = ($page - 1) * $perPage;
        $stmt = $this->pdo->prepare(
            "SELECT v.*, c.nom_categorie
             FROM vehicules v
             LEFT JOIN categories c ON c.Id_categories = v.Id_categories
             WHERE " . implode(' AND ', $where) . "
             ORDER BY c.nom_categorie, v.marque, v.model
             LIMIT :limit OFFSET :offset"
        );
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v);
        }
        $stmt->bindValue('limit',  $perPage, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset,  PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countAvailable(?int $catId = null, ?string $search = null): int
    {
        $where  = ['v.disponibilite = 1'];
        $params = [];

        if ($catId) {
            $where[]          = 'v.Id_categories = :cat_id';
            $params['cat_id'] = $catId;
        }
        if ($search) {
            $where[]     = '(v.marque LIKE :s OR v.model LIKE :s OR v.description LIKE :s OR v.nom LIKE :s)';
            $params['s'] = '%' . $search . '%';
        }

        $stmt = $this->pdo->prepare(
            "SELECT COUNT(*) FROM vehicules v WHERE " . implode(' AND ', $where)
        );
        $stmt->execute($params);
        return (int) $stmt->fetchColumn();
    }

    public function findById(int $id): array|false
    {
        $stmt = $this->pdo->prepare(
            "SELECT v.*, c.nom_categorie
             FROM vehicules v
             LEFT JOIN categories c ON c.Id_categories = v.Id_categories
             WHERE v.Id_vehicules = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function insert(
        string $marque,
        string $model,
        string $description,
        string $nom,
        float  $prix,
        int    $disponibilite,
        int    $id_categories
    ): bool {
        $stmt = $this->pdo->prepare(
            "INSERT INTO vehicules (marque, model, description, nom, prix, disponibilite, Id_categories)
             VALUES (:marque, :model, :description, :nom, :prix, :dispo, :cat)"
        );
        return $stmt->execute([
            'marque'      => $marque,
            'model'       => $model,
            'description' => $description,
            'nom'         => $nom,
            'prix'        => $prix,
            'dispo'       => $disponibilite ? 1 : 0,
            'cat'         => $id_categories,
        ]);
    }

    public function update(
        int    $id,
        string $marque,
        string $model,
        string $description,
        string $nom,
        float  $prix,
        int    $disponibilite,
        int    $id_categories
    ): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE vehicules
             SET marque=:marque, model=:model, description=:description, nom=:nom,
                 prix=:prix, disponibilite=:dispo, Id_categories=:cat
             WHERE Id_vehicules=:id"
        );
        return $stmt->execute([
            'id'          => $id,
            'marque'      => $marque,
            'model'       => $model,
            'description' => $description,
            'nom'         => $nom,
            'prix'        => $prix,
            'dispo'       => $disponibilite ? 1 : 0,
            'cat'         => $id_categories,
        ]);
    }

    public function delete(int $id): bool
    {
        // Supprimer d'abord les réservations liées (contrainte foreign key)
        $stmt = $this->pdo->prepare("DELETE FROM reservations WHERE Id_vehicules = :id");
        $stmt->execute(['id' => $id]);

        $stmt = $this->pdo->prepare("DELETE FROM vehicules WHERE Id_vehicules = :id");
        return $stmt->execute(['id' => $id]);
    }
}
