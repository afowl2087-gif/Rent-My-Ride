<?php

require_once '../models/vehicle.php';

$id = $_GET['id'] ?? 1;

$vehicle = Vehicle::getVehicleById($id);

require '../views/detail.php';