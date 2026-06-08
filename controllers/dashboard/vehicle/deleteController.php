<?php
require_once __DIR__ . '/../../../models/vehicle.php';

$id = (int) ($_GET['id'] ?? 0);
if ($id > 0) {
    (new Vehicle())->delete($id);
    $_SESSION['flash'] = ['type' => 'warning', 'msg' => 'Véhicule supprimé.'];
}
header('Location: /dashboard/vehicle/list');
exit;
