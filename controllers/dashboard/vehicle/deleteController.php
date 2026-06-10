<?php
require_once __DIR__ . '/../../../bootstrap.php';
requireAdmin();
require_once __DIR__ . '/../../../models/vehicle.php';


$id = (int) ($_GET['id'] ?? 0);
if ($id > 0) {
    (new Vehicle())->delete($id);
    $_SESSION['flash'] = ['type' => 'warning', 'msg' => 'Véhicule supprimé.'];
}
header('Location: /controllers/dashboard/vehicle/listController.php');
exit;
