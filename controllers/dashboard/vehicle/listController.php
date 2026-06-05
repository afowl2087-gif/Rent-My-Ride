<?php
require_once ROOT . '/models/vehicle.php';

$vehicle  = new Vehicle();
$vehicles = $vehicle->getAll();

$pageTitle = 'Véhicules';
require ROOT . '/views/dashboard/vehicle/list.php';