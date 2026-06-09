<?php

require_once ROOT . '/models/user.php';

$user = new User();
$users = $user->getArchived();

$pageTitle = 'Utilisateurs archivés';
require ROOT . '/views/dashboard/users/list-archived.php';