<?php require 'partials/header.php'; ?>

<section class="details-container">

    <img
        src="<?= $vehicle['image'] ?>"
        class="details-image"
    >

    <div class="details-content">

        <h1>

            <?= $vehicle['brand'] ?>
            <?= $vehicle['model'] ?>

        </h1>

        <p>

            <?= $vehicle['description'] ?>

        </p>

        <h3>

            <?= $vehicle['price'] ?>

        </h3>

        <p>

            Catégorie :
            <?= $vehicle['category'] ?>

        </p>

        <a href="index.php?page=reservation">

            <button class="reserve-btn">

                Réserver

            </button>

        </a>

    </div>

</section>

<?php require 'partials/footer.php'; ?>