<?php

require_once __DIR__ . '/../config/database.php';

class Reservation
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = getDB();
    }

    // GET ALL (dashboard — toutes les réservations)
    public function getAll()
    {
        $stmt = $this->pdo->query(
            "SELECT r.*,
                    v.marque, v.model, v.nom AS nom_vehicule, v.prix,
                    u.nom, u.prenom, u.email, u.telephone
             FROM reservations r
                JOIN vehicules v ON v.Id_vehicules = r.Id_vehicules
                JOIN users     u ON u.Id_users     = r.Id_users
                WHERE r.is_archived = 0
                ORDER BY r.date_debut DESC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // GET UPCOMING (réservations à venir)
    public function getUpcoming()
    {
        $stmt = $this->pdo->query(
            "SELECT r.*,
                    v.marque, v.model, v.nom AS nom_vehicule, v.prix,
                    u.nom, u.prenom, u.email, u.telephone
             FROM reservations r
             JOIN vehicules v ON v.Id_vehicules = r.Id_vehicules
             JOIN users     u ON u.Id_users     = r.Id_users
             WHERE r.date_fin >= CURDATE()
             ORDER BY r.date_debut ASC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // FIND BY ID
    public function findById($id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT r.*,
                    v.marque, v.model, v.nom AS nom_vehicule, v.prix,
                    u.nom, u.prenom, u.email, u.telephone
             FROM reservations r
             JOIN vehicules v ON v.Id_vehicules = r.Id_vehicules
             JOIN users     u ON u.Id_users     = r.Id_users
             WHERE r.Id_reservations = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // INSERT
    public function insert($date_debut, $date_fin, $statut, $id_vehicules, $id_users)
    {
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

    // UPDATE STATUT
    public function updateStatut($id, $statut)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE reservations SET statut = :statut WHERE Id_reservations = :id"
        );
        return $stmt->execute(['statut' => $statut, 'id' => $id]);
    }
    public function archiveByUser($userId)
    {
        $stmt = $this->pdo->prepare("
            UPDATE reservations
            SET is_archived = 1
            WHERE Id_users = :id
    ");

    return $stmt->execute([
        'id' => $userId
    ]);
    }

    public function restoreByUser($userId)
{
    $stmt = $this->pdo->prepare("
        UPDATE reservations
        SET is_archived = 0
        WHERE Id_users = :id
    ");

    return $stmt->execute([
        'id' => $userId
    ]);
}
    // DELETE
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM reservations WHERE Id_reservations = :id");
        return $stmt->execute(['id' => $id]);
    }
}