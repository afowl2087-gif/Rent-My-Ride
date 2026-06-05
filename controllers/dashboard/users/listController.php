<?php
declare(strict_types=1);
require_once ROOT . '/models/user.php';

$users     = (new User())->getAll();
$pageTitle = 'Utilisateurs';
require ROOT . '/views/dashboard/users/list.php';