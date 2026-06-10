<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../bootstrap.php';
require_once __DIR__ . '/../../../models/user.php';

$users     = (new User())->getAll();
$pageTitle = 'Utilisateurs';
require __DIR__ . '/../../../views/dashboards/users/list.php';
