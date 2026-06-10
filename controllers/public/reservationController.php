<?php
require_once __DIR__ . '/../../bootstrap.php';
require_once  __DIR__. '/../../models/vehicle.php';
require_once __DIR__ . '/../../models/user.php';
require_once __DIR__ . '/../../models/reservation.php';

$id      = (int) ($_GET['id'] ?? 0);
$vehicle = (new Vehicle())->findById($id);

if (!$id || !$vehicle || !$vehicle['disponibilite']) {
    header('Location: /controllers/public/homeController.php');
    exit;
}

$errors = [];
$data   = ['nom'=>'','prenom'=>'','email'=>'','telephone'=>'','date_debut'=>'','date_fin'=>''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($data as $k => $_) {
        $data[$k] = trim($_POST[$k] ?? '');
    }

    if (empty($data['nom']))     $errors[] = 'Le nom est obligatoire.';
    if (empty($data['prenom']))  $errors[] = 'Le prénom est obligatoire.';
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Adresse e-mail invalide.';
    }
    if (empty($data['date_debut'])) $errors[] = 'La date de début est obligatoire.';
    if (empty($data['date_fin']))   $errors[] = 'La date de fin est obligatoire.';

    if (empty($errors)) {
        $debut = new DateTime($data['date_debut']);
        $fin   = new DateTime($data['date_fin']);

        if ($debut >= $fin) {
            $errors[] = 'La date de fin doit être après la date de début.';
        } elseif ($debut < new DateTime('today')) {
            $errors[] = 'La date de début ne peut pas être dans le passé.';
        }

        if (empty($errors)) {
            // Transaction manuelle : insérer le client PUIS la réservation
            $db  = new Database();
            $pdo = $db->getConnection();

            try {
                $pdo->beginTransaction();

                $user   = new User();
                $userId = $user->insert(
                    $data['nom'], $data['prenom'],
                    $data['email'], $data['telephone']
                );

                if (!$userId) throw new Exception("Erreur création utilisateur.");

                $jours = (int) $debut->diff($fin)->days;
                $total = round($jours * (float)$vehicle['prix'], 2);

                $reservation = new Reservation();
                $ok = $reservation->insert(
                    $data['date_debut'], $data['date_fin'],
                    'en attente', $id, $userId
                );

                if (!$ok) throw new Exception("Erreur création réservation.");

                $pdo->commit();

                $_SESSION['flash'] = [
                    'type' => 'success',
                    'msg'  => "Réservation enregistrée ! Total estimé : " . number_format($total, 2, ',', ' ') . " €.",
                ];
                header("Location: /controllers/public/confirmationController.php");
                exit;

            } catch (Exception $e) {
                $pdo->rollBack();
                $errors[] = "Une erreur est survenue. Réservation non enregistrée.";
            }
        }
    }
}

$pageTitle = 'Réserver – ' . $vehicle['marque'] . ' ' . $vehicle['model'];
require __DIR__ . '/../../views/dashboards/reservation/formulaire-reservation.php';