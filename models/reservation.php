<?php

require_once __DIR__ . '/../config/database.php';

class Reservation
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll(): array
    {
        return $this->pdo->query(
            "SELECT r.*,
                    v.marque, v.model, v.nom AS nom_vehicule, v.prix,
                    u.nom, u.prenom, u.email, u.telephone
             FROM reservations r
             JOIN vehicules v ON v.Id_vehicules = r.Id_vehicules
             JOIN users     u ON u.Id_users     = r.Id_users
             ORDER BY r.date_debut DESC"
        )->fetchAll();
    }

    public function getUpcoming(): array
    {
        return $this->pdo->query(
            "SELECT r.*,
                    v.marque, v.model, v.nom AS nom_vehicule, v.prix,
                    u.nom, u.prenom, u.email, u.telephone
             FROM reservations r
             JOIN vehicules v ON v.Id_vehicules = r.Id_vehicules
             JOIN users     u ON u.Id_users     = r.Id_users
             WHERE r.date_fin >= CURDATE()
             ORDER BY r.date_debut ASC"
        )->fetchAll();
    }

    // CORRIGÉ : était "SELECT * FROM categories" au lieu de reservations
    public function findById(int $id): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM reservations WHERE Id_reservations = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function insert(
        string $date_debut,
        string $date_fin,
        string $statut,
        int    $id_vehicules,
        int    $id_users
    ): bool {
        $stmt = $this->pdo->prepare(
            "INSERT INTO reservations (date_debut, date_fin, statut, Id_vehicules, Id_users)
             VALUES (:debut, :fin, :statut, :vid, :uid)"
        );
        return $stmt->execute([
            'debut'  => $date_debut,
            'fin'    => $date_fin,
            'statut' => $statut,
            'vid'    => $id_vehicules,
            'uid'    => $id_users,
        ]);
    }

    public function updateStatut(int $id, string $statut): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE reservations SET statut = :statut WHERE Id_reservations = :id"
        );
        return $stmt->execute(['statut' => $statut, 'id' => $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM reservations WHERE Id_reservations = :id");
        return $stmt->execute(['id' => $id]);
    }
}
