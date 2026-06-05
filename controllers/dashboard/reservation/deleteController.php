<?php
require_once ROOT . '/models/reservation.php';

$id = (int) ($_GET['id'] ?? 0);
if ($id) {
    $reservation = new Reservation();
    $reservation->delete($id);
    $_SESSION['flash'] = ['type' => 'warning', 'msg' => 'Réservation supprimée.'];
}
header('Location: /dashboard/reservation/list');
exit;