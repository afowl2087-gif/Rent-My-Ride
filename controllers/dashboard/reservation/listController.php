<?php
require_once ROOT . '/models/reservation.php';

$reservation  = new Reservation();
$reservations = $reservation->getAll();

// Changer le statut d'une réservation
if (isset($_GET['statut'], $_GET['id']) && is_numeric($_GET['id'])) {
    $statutsValides = ['en attente', 'confirmée', 'annulée'];
    $nouveauStatut  = $_GET['statut'];
    if (in_array($nouveauStatut, $statutsValides)) {
        $reservation->updateStatut((int) $_GET['id'], $nouveauStatut);
        $_SESSION['flash'] = ['type' => 'success', 'msg' => "Statut mis à jour : « {$nouveauStatut} »."];
    }
    header('Location: /dashboard/reservation/list');
    exit;
}

$pageTitle = 'Réservations';
require ROOT . '/views/dashboard/reservation/list-reservation.php';