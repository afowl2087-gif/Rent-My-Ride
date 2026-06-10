<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../bootstrap.php';
requireAdmin();
require_once __DIR__ . '/../../../models/user.php';


$id = (int) ($_GET['id'] ?? 0);
if ($id > 0) {
    (new User())->delete($id);
    $_SESSION['flash'] = ['type' => 'warning', 'msg' => 'Utilisateur supprimé.'];
}
header('Location: /controllers/dashboard/users/listController.php');
exit;
