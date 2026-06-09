<?php

require_once ROOT . '/models/user.php';
require_once ROOT . '/models/reservation.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id) {

    $user = new User();
    $user->archive($id);

    $reservation = new Reservation();
    $reservation->archiveByUser($id);

    $_SESSION['flash'] = [
        'type' => 'warning',
        'msg'  => 'Utilisateur et réservations archivés.'
    ];
}

header('Location: /dashboard/users/list');
exit;