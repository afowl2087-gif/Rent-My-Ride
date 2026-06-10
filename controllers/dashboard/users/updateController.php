<?php
require_once __DIR__ . '/../../../bootstrap.php';
requireAdmin();
require_once __DIR__ . '/../../../models/user.php';


$id   = (int) ($_GET['id'] ?? 0);
$user = new User();
$row  = $user->findById($id);

if (!$id || !$row) {
    header('Location: /controllers/dashboard/users/listController.php');
    exit;
}

$errors = [];
$data   = [
    'nom'       => $row['nom'],
    'prenom'    => $row['prenom'],
    'email'     => $row['email'],
    'telephone' => $row['telephone'],
    'role'      => $row['role'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['nom']       = trim($_POST['nom']       ?? '');
    $data['prenom']    = trim($_POST['prenom']    ?? '');
    $data['email']     = trim($_POST['email']     ?? '');
    $data['telephone'] = trim($_POST['telephone'] ?? '');
    $data['role']      = (int) ($_POST['role']    ?? 0);

    if (empty($data['nom']))    $errors[] = 'Le nom est obligatoire.';
    if (empty($data['prenom'])) $errors[] = 'Le prénom est obligatoire.';
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Adresse e-mail invalide.';
    }

    if (empty($errors)) {
        if ($user->emailExists($data['email'], $id)) {
            $errors[] = 'Cette adresse e-mail est déjà utilisée par un autre utilisateur.';
        } else {
            if ($user->update(
                $id,
                $data['nom'],
                $data['prenom'],
                $data['email'],
                $data['telephone'],
                $data['role']
            )) {
                $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Utilisateur mis à jour.'];
                header('Location: /controllers/dashboard/users/listController.php');
                exit;
            }
            $errors[] = 'Erreur lors de la mise à jour.';
        }
    }
}

$pageTitle = "Modifier l'utilisateur";
require __DIR__ . '/../../../views/dashboards/users/update.php';
