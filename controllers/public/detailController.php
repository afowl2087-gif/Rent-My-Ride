<?php
require_once ROOT . '/models/vehicle.php';

$id      = (int) ($_GET['id'] ?? 0);
$vehicle = (new Vehicle())->findById($id);

if (!$id || !$vehicle) {
    header('Location: /');
    exit;
}

$pageTitle = $vehicle['marque'] . ' ' . $vehicle['model'];
require ROOT . '/views/detail.php';