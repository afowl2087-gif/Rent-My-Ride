<?php
require_once __DIR__ . '/../../../models/category.php';

$errors = [];
$nom    = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom_categorie'] ?? '');

    if (empty($nom)) {
        $errors[] = 'Le nom de la catégorie est obligatoire.';
    } else {
        $category = new Category();
        if ($category->isExist($nom)) {
            $errors[] = 'Cette catégorie existe déjà.';
        } else {
            $category->setName($nom);
            if ($category->insert()) {
                $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Catégorie ajoutée avec succès.'];
                header('Location: /controllers/dashboard/categories/listController');
                exit;
            }
            $errors[] = "Erreur lors de l'ajout.";
        }
    }
}

$pageTitle = 'Ajouter une catégorie';
require __DIR__ . '/../../../views/dashboard/categories/add-form.php';