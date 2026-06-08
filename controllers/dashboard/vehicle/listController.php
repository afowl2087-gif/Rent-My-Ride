<?php
require_once __DIR__ . '/../../../models/vehicle.php';

$vehicle  = new Vehicle();
$vehicles = $vehicle->getAll();

$pageTitle = 'Véhicules';
require __DIR__ . '/../../../views/dashboard/vehicle/list.php';