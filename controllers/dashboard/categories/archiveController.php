<?php

require_once ROOT . '/models/category.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: /dashboard/categories/list');
    exit;
}

$category = new Category();
$category->archive($id);

$_SESSION['flash'] = [
    'type' => 'success',
    'msg'  => 'Catégorie archivée avec succès.'
];

header('Location: /dashboard/categories/list');
exit;