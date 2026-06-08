<?php
require_once __DIR__ . '/../../../models/reservation.php';
require_once __DIR__ . '/../../../models/vehicle.php';
require_once __DIR__ . '/../../../models/user.php';

$vehicles = (new Vehicle())->getAll();
$users    = (new User())->getAll();
$errors   = [];
$data     = [
    'Id_vehicules' => 0,
    'Id_users'     => 0,
    'date_debut'   => '',
    'date_fin'     => '',
    'statut'       => 'en attente',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['Id_vehicules'] = (int)   ($_POST['Id_vehicules'] ?? 0);
    $data['Id_users']     = (int)   ($_POST['Id_users']     ?? 0);
    $data['date_debut']   = trim($_POST['date_debut']       ?? '');
    $data['date_fin']     = trim($_POST['date_fin']         ?? '');
    $data['statut']       = trim($_POST['statut']           ?? 'en attente');

    if (empty($data['Id_vehicules'])) $errors[] = 'Veuillez sélectionner un véhicule.';
    if (empty($data['Id_users']))     $errors[] = 'Veuillez sélectionner un client.';
    if (empty($data['date_debut']))   $errors[] = 'La date de début est obligatoire.';
    if (empty($data['date_fin']))     $errors[] = 'La date de fin est obligatoire.';

    if (empty($errors)) {
        $debut = new DateTime($data['date_debut']);
        $fin   = new DateTime($data['date_fin']);
        if ($debut >= $fin) {
            $errors[] = 'La date de fin doit être après la date de début.';
        }
    }

    if (empty($errors)) {
        if ((new Reservation())->insert(
            $data['date_debut'],
            $data['date_fin'],
            $data['statut'],
            $data['Id_vehicules'],
            $data['Id_users']
        )) {
            $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Réservation ajoutée avec succès.'];
            header('Location: /dashboard/reservation/list');
            exit;
        }
        $errors[] = "Erreur lors de l'ajout.";
    }
}

$pageTitle = 'Ajouter une réservation';
require __DIR__ . '/../../../views/dashboard/reservation/add-form.php';
