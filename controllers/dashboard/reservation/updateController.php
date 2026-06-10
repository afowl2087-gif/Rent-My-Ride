<?php
require_once __DIR__ . '/../../../bootstrap.php';
requireAdmin();
require_once __DIR__ . '/../../../models/reservation.php';
require_once __DIR__ . '/../../../models/vehicle.php';
require_once __DIR__ . '/../../../models/user.php';


$id          = (int) ($_GET['id'] ?? 0);
$reservation = new Reservation();
$data        = $reservation->findById($id);

if (!$id || !$data) {
    header('Location: /dashboard/reservation/list');
    exit;
}

$vehicles = (new Vehicle())->getAll();
$users    = (new User())->getAll();
$errors   = [];

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
        // Mise à jour via le modèle Reservation (updateStatut étendu ici inline
        // car le modèle n'a pas de méthode update complète)
        $pdo  = (new Database())->getConnection();
        $stmt = $pdo->prepare(
            "UPDATE reservations
             SET date_debut=:debut, date_fin=:fin, statut=:statut,
                 Id_vehicules=:vid, Id_users=:uid
             WHERE Id_reservations=:id"
        );
        if ($stmt->execute([
            'debut'  => $data['date_debut'],
            'fin'    => $data['date_fin'],
            'statut' => $data['statut'],
            'vid'    => $data['Id_vehicules'],
            'uid'    => $data['Id_users'],
            'id'     => $id,
        ])) {
            $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Réservation mise à jour.'];
            header('Location: /controllers/dashboard/reservation/listController.php');
            exit;
        }
        $errors[] = 'Erreur lors de la mise à jour.';
    }
}

$pageTitle = 'Modifier la réservation';
require __DIR__ . '/../../../views/dashboards/reservation/update.php';
