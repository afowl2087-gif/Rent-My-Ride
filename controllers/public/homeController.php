<?php
require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/../../models/vehicle.php';
require_once __DIR__ . '/../../models/category.php';

$perPage    = 10;
$page       = max(1, (int) ($_GET['page'] ?? 1));
$categoryId = !empty($_GET['cat']) ? (int) $_GET['cat'] : null;
$search     = trim($_GET['q'] ?? '');

$vehicle    = new Vehicle();
$total      = $vehicle->countAvailable($categoryId, $search ?: null);
$totalPages = max(1, (int) ceil($total / $perPage));
$page       = min($page, $totalPages);
$vehicles   = $vehicle->getAllAvailable($categoryId, $search ?: null, $page, $perPage);

$categories = (new Category())->getAll();

$pageTitle = 'Véhicules disponibles';
require __DIR__ . '/../../views/home-cards.php';