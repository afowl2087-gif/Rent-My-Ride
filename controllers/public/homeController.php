<?php

require_once '../models/vehicle.php';

$vehicles = Vehicle::getAllVehicles();

require '../views/home-cards.php';