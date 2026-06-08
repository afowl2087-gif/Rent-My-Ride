<?php
require_once __DIR__ . '/../../../models/category.php';

$id = (int) ($_GET['id'] ?? 0);
if ($id) {
    $category = new Category();
    $category->delete($id);
    $_SESSION['flash'] = ['type' => 'warning', 'msg' => 'Catégorie supprimée.'];
}
header('Location: controllers/dashboard/categories/listController');
exit;