<?php
require_once __DIR__ . '/../../../bootstrap.php';
requireAdmin();
require_once __DIR__ . '/../../../models/category.php';


$errors = [];
$nom    = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom_categorie'] ?? '');

    if (empty($nom)) {
        $errors[] = 'Le nom de la catégorie est obligatoire.';
    } elseif ((new Category())->isExist($nom)) {
        $errors[] = 'Cette catégorie existe déjà.';
    } else {
        $category = new Category();
        if ($category->insert($nom)) {
            $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Catégorie ajoutée avec succès.'];
            header('Location: /controllers/dashboard/categories/listController.php');
            exit;
        }
        $errors[] = "Erreur lors de l'ajout.";
    }
}

$pageTitle = 'Ajouter une catégorie';
require __DIR__ . '/../../../views/dashboards/categories/add-form.php';
