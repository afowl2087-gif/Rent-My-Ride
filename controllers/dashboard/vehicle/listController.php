<?php
require_once __DIR__ . '/../../../models/vehicle.php';

$vehicles  = (new Vehicle())->getAll();
$pageTitle = 'Véhicules';
require __DIR__ . '/../../../views/dashboard/vehicle/list.php';
