<?php

$page = $_GET['page'] ?? 'home';

switch($page){

    case 'details':

        require '../controllers/public/detailController.php';
        break;

    case 'reservation':

        require '../controllers/public/reservationController.php';
        break;

    default:

        require '../controllers/public/homeController.php';
        break;
}