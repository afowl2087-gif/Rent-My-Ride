<?php

require_once ROOT . '/models/User.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $userModel = new User();
    $user = $userModel->findByEmail($email);

    if (
        $user &&
        $user['role'] == 1 &&
        password_verify($password, $user['mot_de_passe'])
    ) {

        $_SESSION['admin'] = [
            'id' => $user['Id_users'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom']
        ];

        header('Location: /dashboard/categories/list');
        exit;
    }

    $errors[] = "Accès refusé (admin uniquement ou mot de passe incorrect).";
}

$pageTitle = "Connexion Admin";
require ROOT . '/views/login.php';
