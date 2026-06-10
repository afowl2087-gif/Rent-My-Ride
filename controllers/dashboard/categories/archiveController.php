<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../bootstrap.php';
require_once __DIR__ . '/../../../models/category.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$id) {
    header('Location: /controllers/dashboard/categories/listController.php');
    exit;
}

$pdo = getDB();

// Récupérer la catégorie
$stmt = $pdo->prepare("SELECT * FROM categories WHERE Id_categories = :id");
$stmt->execute(['id' => $id]);
$cat = $stmt->fetch();

if (!$cat) {
    $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Catégorie introuvable.'];
    header('Location: /controllers/dashboard/categories/listController.php');
    exit;
}

// Archiver
$stmt = $pdo->prepare("INSERT INTO categories_archives (id_origine, nom_categorie) VALUES (:id, :nom)");
$stmt->execute(['id' => $cat['Id_categories'], 'nom' => $cat['nom_categorie']]);

// Détacher les véhicules liés (mettre Id_categories à NULL)
$stmt = $pdo->prepare("UPDATE vehicules SET Id_categories = NULL WHERE Id_categories = :id");
$stmt->execute(['id' => $id]);

// Supprimer la catégorie
$stmt = $pdo->prepare("DELETE FROM categories WHERE Id_categories = :id");
$stmt->execute(['id' => $id]);

$_SESSION['flash'] = ['type' => 'success', 'msg' => 'Catégorie archivée avec succès.'];
header('Location: /controllers/dashboard/categories/listController.php');
exit;
