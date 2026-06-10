<?php
require_once __DIR__ . '/../../../bootstrap.php';
require_once __DIR__ . '/../../../models/reservation.php';

$id = (int) ($_GET['id'] ?? 0);
if ($id > 0) {
    (new Reservation())->delete($id);
    $_SESSION['flash'] = ['type' => 'warning', 'msg' => 'Réservation supprimée.'];
}
header('Location: /controllers/dashboard/reservation/listController.php');
exit;
