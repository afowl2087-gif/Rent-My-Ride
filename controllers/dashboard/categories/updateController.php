<?php
require_once __DIR__ . '/../../../models/category.php';

$id       = (int) ($_GET['id'] ?? 0);
$category = new Category();
$row      = $category->findById($id);

if (!$id || !$row) {
    header('Location: /dashboard/categories/list');
    exit;
}

$errors = [];
$nom    = $row['nom_categorie'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom_categorie'] ?? '');

    if (empty($nom)) {
        $errors[] = 'Le nom est obligatoire.';
    } elseif ($category->isExist($nom, $id)) {
        $errors[] = 'Une autre catégorie porte déjà ce nom.';
    } else {
        if ($category->update($id, $nom)) {
            $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Catégorie mise à jour.'];
            header('Location: /dashboard/categories/list');
            exit;
        }
        $errors[] = 'Erreur lors de la mise à jour.';
    }
}

$pageTitle = 'Modifier la catégorie';
require __DIR__ . '/../../../views/dashboard/categories/update.php';
