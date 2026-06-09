<?php
require_once ROOT . '/models/vehicle.php';
require_once ROOT . '/models/category.php';

$errors     = [];
$categories = (new Category())->getAll();
$data = ['marque'=>'','model'=>'','description'=>'','nom'=>'','prix'=>'','disponibilite'=>1,'Id_categories'=>''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['marque']        = trim($_POST['marque'] ?? '');
    $data['model']         = trim($_POST['model'] ?? '');
    $data['description']   = trim($_POST['description'] ?? '');
    $data['nom']           = trim($_POST['nom'] ?? '');
    $data['prix']          = (float) ($_POST['prix'] ?? 0);
    $data['disponibilite'] = isset($_POST['disponibilite']) ? 1 : 0;
    $data['Id_categories'] = (int) ($_POST['Id_categories'] ?? 0);

    if (empty($data['marque']))        $errors[] = 'La marque est obligatoire.';
    if (empty($data['model']))         $errors[] = 'Le modèle est obligatoire.';
    if (empty($data['nom']))           $errors[] = 'Le nom commercial est obligatoire.';
    if ($data['prix'] <= 0)            $errors[] = 'Le prix doit être supérieur à 0.';
    if (empty($data['Id_categories'])) $errors[] = 'La catégorie est obligatoire.';

    $imagePath = null;

if (!empty($_FILES['image']['name'])) {

    $uploadDir = ROOT . '/public/uploads/vehicles/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = time() . '_' . basename($_FILES['image']['name']);
    $targetFile = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        $imagePath = 'uploads/vehicles/' . $filename;
    } else {
        $errors[] = "Erreur lors de l'upload de l'image.";
    }
}
    if (empty($errors)) {
        $vehicle = new Vehicle();
        if ($vehicle->insert(
            $data['marque'], $data['model'], $data['description'], $data['nom'],
            $data['prix'], $data['disponibilite'], $data['Id_categories'], $imagePath
        )) {
            $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Véhicule ajouté avec succès.'];
            header('Location: /dashboard/vehicle/list');
            exit;
        }
        $errors[] = "Erreur lors de l'ajout.";
    }
}

$pageTitle = 'Ajouter un véhicule';
require ROOT . '/views/dashboard/vehicle/add-form.php';