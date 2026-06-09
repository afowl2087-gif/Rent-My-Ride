<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle ?? 'Dashboard') ?> – RentMyRide Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar { min-height: 100vh; background: #212529; }
        .sidebar .nav-link { color: #adb5bd; }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,.08); border-radius: .375rem; }
        .sidebar .nav-section { font-size: .7rem; text-transform: uppercase;
                                letter-spacing: .08em; color: #6c757d; padding: .5rem 1rem; }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 sidebar py-3 px-2 d-flex flex-column">
            <a href="/" class="text-white text-decoration-none mb-4 px-2 d-flex align-items-center gap-2">
                <i class="bi bi-car-front-fill fs-5"></i>
                <span class="fw-bold fs-5">RentMyRide</span>
            </a>

            <span class="nav-section">Catalogue</span>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link px-2 py-2" href="/controllers/dashboard/categories/listController.php">
                        <i class="bi bi-tags me-2"></i> Catégories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 py-2" href="/controllers/dashboard/vehicle/listController.php">
                        <i class="bi bi-car-front me-2"></i> Véhicules
                    </a>
                </li>
            </ul>

            <span class="nav-section">Gestion</span>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link px-2 py-2" href="/controllers/dashboard/reservation/listController.php">
                        <i class="bi bi-calendar-check me-2"></i> Réservations
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 py-2" href="/controllers/dashboard/users/listController.php">
                        <i class="bi bi-people me-2"></i> Utilisateurs
                    </a>
                </li>
            </ul>

            <div class="mt-auto px-2">
                <a href="/" class="nav-link text-secondary">
                    <i class="bi bi-arrow-left me-2"></i> Site public
                </a>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="col-md-9 col-lg-10 py-4 px-4">