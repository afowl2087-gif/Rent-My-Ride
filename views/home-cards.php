<?php require 'partials/header.php'; ?>

<section class="hero">

    <h1>
        Louez le véhicule idéal
    </h1>

    <p>
        Découvrez notre sélection de véhicules disponibles.
    </p>

    <div class="search-bar">

        <input
            type="text"
            placeholder="Rechercher une marque..."
        >

        <button>
            Rechercher
        </button>

    </div>

</section>

<section class="filters">

    <button>Tous</button>
    <button>Berline</button>
    <button>Cabriolet</button>
    <button>Citadine</button>
    <button>SUV</button>

</section>

<section class="cars-grid">

<?php foreach($vehicles as $vehicle){ ?>

    <div class="car-card">

        <img src="<?= $vehicle['image'] ?>">

        <div class="card-content">

            <h3>

                <?= $vehicle['brand'] ?>
                <?= $vehicle['model'] ?>

            </h3>

            <p>

                <?= $vehicle['price'] ?>

            </p>

            <span>

                <?= $vehicle['category'] ?>

            </span>

            <a href="index.php?page=details&id=<?= $vehicle['id'] ?>">

                <button class="see-btn">

                    Voir

                </button>

            </a>

        </div>

    </div>

<?php } ?>

</section>

<?php require 'partials/footer.php'; ?>