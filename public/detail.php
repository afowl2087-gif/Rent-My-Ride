<?php
$vehicle = [
    'id' => 1,
    'brand' => 'BMW',
    'model' => 'X3',
    'category' => 'SUV',
    'price_day' => 75,
    'description' => 'SUV confortable et spacieux, idéal pour les longs trajets.',
    'image' => 'bmw_x3.webp',
    'fuel' => 'Diesel',
    'gearbox' => 'Automatique',
    'seats' => 5,
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail du véhicule</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .vehicle-image {
            width: 100%;
            max-height: 450px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container my-5">

    <div class="row">

        <div class="col-md-6">
            
            <img src="./bmw_x3.webp" alt="BMW X3" style="width:300px;">

        </div>

        <div class="col-md-6">

            <h1>
                <?= htmlspecialchars($vehicle['brand']) ?>
                <?= htmlspecialchars($vehicle['model']) ?>
            </h1>

            <h2>Informations générales</h2>

            <p class="fs-3 fw-bold text-success">
                <?= number_format($vehicle['price_day'], 2, ',', ' ') ?> € / jour
            </p>

            <h2>Description</h2>

            <p>
                <?= htmlspecialchars($vehicle['description']) ?>
            </p>

            <ul class="list-group mt-4">
                <li class="list-group-item">
                    <strong>Catégorie :</strong> <?= htmlspecialchars($vehicle['category']) ?>
                </li>
                <li class="list-group-item">
                    <strong>Carburant :</strong> <?= htmlspecialchars($vehicle['fuel']) ?>
                </li>
                <li class="list-group-item">
                    <strong>Boîte :</strong> <?= htmlspecialchars($vehicle['gearbox']) ?>
                </li>
                <li class="list-group-item">
                    <strong>Places :</strong> <?= htmlspecialchars($vehicle['seats']) ?>
                </li>
            </ul>

        </div>

    </div>

</div>

</body>
</html>