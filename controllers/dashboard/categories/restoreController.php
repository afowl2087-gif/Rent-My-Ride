<?php

require_once ROOT . '/models/category.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id > 0) {
    $category = new Category();
    $category->restore($id);

    $_SESSION['flash'] = [
        'type' => 'success',
        'msg'  => 'Catégorie restaurée avec succès.'
    ];
}

header('Location: /dashboard/categories/archived');
exit;