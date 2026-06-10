<?php
declare(strict_types=1);
require_once __DIR__ . '/../../../bootstrap.php';
require_once __DIR__ . '/../../../models/user.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$id) {
    header('Location: /controllers/dashboard/users/listController.php');
    exit;
}

$pdo = getDB();

// Récupérer l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM users WHERE Id_users = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();

if (!$user) {
    $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Utilisateur introuvable.'];
    header('Location: /controllers/dashboard/users/listController.php');
    exit;
}

// Archiver
$stmt = $pdo->prepare("INSERT INTO users_archives (id_origine, nom, prenom, email, telephone, role) VALUES (:id, :nom, :prenom, :email, :tel, :role)");
$stmt->execute([
    'id'     => $user['Id_users'],
    'nom'    => $user['nom'],
    'prenom' => $user['prenom'],
    'email'  => $user['email'],
    'tel'    => $user['telephone'],
    'role'   => $user['role'],
]);

// Détacher les réservations liées (mettre Id_users à NULL)
$stmt = $pdo->prepare("UPDATE reservations SET Id_users = NULL WHERE Id_users = :id");
$stmt->execute(['id' => $id]);

// Supprimer l'utilisateur
$stmt = $pdo->prepare("DELETE FROM users WHERE Id_users = :id");
$stmt->execute(['id' => $id]);

$_SESSION['flash'] = ['type' => 'success', 'msg' => 'Utilisateur archivé avec succès.'];
header('Location: /controllers/dashboard/users/listController.php');
exit;
