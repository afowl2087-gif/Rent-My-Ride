<?php
require_once __DIR__ . '/../../../bootstrap.php';
require_once __DIR__ . '/../../../models/vehicle.php';
require_once __DIR__ . '/../../../models/category.php';

$categories = (new Category())->getAll();
$errors     = [];
$data       = [
    'marque'        => '',
    'model'         => '',
    'description'   => '',
    'nom'           => '',
    'prix'          => '',
    'disponibilite' => 1,
    'Id_categories' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['marque']        = trim($_POST['marque']       ?? '');
    $data['model']         = trim($_POST['model']        ?? '');
    $data['description']   = trim($_POST['description']  ?? '');
    $data['nom']           = trim($_POST['nom']          ?? '');
    $data['prix']          = (float) ($_POST['prix']     ?? 0);
    $data['disponibilite'] = isset($_POST['disponibilite']) ? 1 : 0;
    $data['Id_categories'] = (int) ($_POST['Id_categories'] ?? 0);

    if (empty($data['marque']))        $errors[] = 'La marque est obligatoire.';
    if (empty($data['model']))         $errors[] = 'Le modèle est obligatoire.';
    if (empty($data['nom']))           $errors[] = 'Le nom commercial est obligatoire.';
    if ($data['prix'] <= 0)            $errors[] = 'Le prix doit être supérieur à 0.';
    if (empty($data['Id_categories'])) $errors[] = 'La catégorie est obligatoire.';

    if (empty($errors)) {
        if ((new Vehicle())->insert(
            $data['marque'],
            $data['model'],
            $data['description'],
            $data['nom'],
            $data['prix'],
            $data['disponibilite'],
            $data['Id_categories']
        )) {
            $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Véhicule ajouté avec succès.'];
            header('Location: /controllers/dashboard/vehicle/listController.php');
            exit;
        }
        $errors[] = "Erreur lors de l'ajout.";
    }
}

$pageTitle = 'Ajouter un véhicule';
require __DIR__ . '/../../../views/dashboards/vehicle/add-form.php';
