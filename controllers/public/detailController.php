<?php
require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/../../models/vehicle.php';

$id      = (int) ($_GET['id'] ?? 0);
$vehicle = (new Vehicle())->findById($id);

if (!$id || !$vehicle) {
    header('Location: /');
    exit;
}

$pageTitle = $vehicle['marque'] . ' ' . $vehicle['model'];
require __DIR__ . '/../../views/detail.php';