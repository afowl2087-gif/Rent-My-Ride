<?php
require_once ROOT . '/models/user.php';

$errors = [];
$data   = [
    'nom'        => '',
    'prenom'     => '',
    'email'      => '',
    'telephone'  => '',
    'mot_de_passe' => '',
    'role'       => 0,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['nom']           = trim($_POST['nom']           ?? '');
    $data['prenom']        = trim($_POST['prenom']        ?? '');
    $data['email']         = trim($_POST['email']         ?? '');
    $data['telephone']     = trim($_POST['telephone']     ?? '');
    $data['mot_de_passe']  = trim($_POST['mot_de_passe']  ?? '');
    $data['role']          = (int) ($_POST['role']        ?? 0);

    if (empty($data['nom']))    $errors[] = 'Le nom est obligatoire.';
    if (empty($data['prenom'])) $errors[] = 'Le prénom est obligatoire.';
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Adresse e-mail invalide.';
    }

    if (empty($errors)) {
        $user = new User();
        if ($user->emailExists($data['email'])) {
            $errors[] = 'Cette adresse e-mail est déjà utilisée.';
        } else {
            $mdp = !empty($data['mot_de_passe'])
                ? password_hash($data['mot_de_passe'], PASSWORD_DEFAULT)
                : '';

            if ($user->insert(
                $data['nom'],
                $data['prenom'],
                $data['email'],
                $data['telephone'],
                $mdp,
                $data['role']
            )) {
                $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Utilisateur ajouté avec succès.'];
                header('Location: /dashboard/users/list');
                exit;
            }
            $errors[] = "Erreur lors de l'ajout.";
        }
    }
}

$pageTitle = 'Ajouter un utilisateur';
require ROOT . '/views/dashboard/users/add-form.php';