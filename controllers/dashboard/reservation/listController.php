<?php
require_once __DIR__ . '/../../../bootstrap.php';
requireAdmin();
require_once __DIR__ . '/../../../models/reservation.php';


$reservation = new Reservation();

if (isset($_GET['statut'], $_GET['id']) && is_numeric($_GET['id'])) {
    $statutsValides = ['en attente', 'confirmée', 'annulée'];
    $nouveauStatut  = $_GET['statut'];
    if (in_array($nouveauStatut, $statutsValides, true)) {
        $reservation->updateStatut((int) $_GET['id'], $nouveauStatut);
        $_SESSION['flash'] = ['type' => 'success', 'msg' => "Statut mis à jour : « {$nouveauStatut} »."];
    }
    header('Location: /controllers/dashboard/reservation/listController.php');
    exit;
}

$reservations = $reservation->getAll();
$pageTitle    = 'Réservations';
require __DIR__ . '/../../../views/dashboards/reservation/list-reservation.php';
