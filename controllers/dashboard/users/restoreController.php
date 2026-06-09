<?php

require_once ROOT . '/models/user.php';
require_once ROOT . '/models/reservation.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id) {
    $user = new User();
    $user->restore($id);

    $reservation = new Reservation();
    $reservation->restoreByUser($id);

    $_SESSION['flash'] = [
        'type' => 'success',
        'msg'  => 'Utilisateur restauré avec succès.'
    ];
}

header('Location: /dashboard/users/list');
exit;