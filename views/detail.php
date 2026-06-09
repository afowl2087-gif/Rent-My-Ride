<?php require ROOT . '/views/layouts/header.php'; ?>

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-<?= $_SESSION['flash']['type'] === 'success' ? 'success' : 'warning' ?> alert-dismissible fade show">
        <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="mb-3">
    <a href="/" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left me-1"></i> Retour aux véhicules
    </a>
</div>

<div class="row g-4">

    <!-- COLONNE GAUCHE : INFOS VEHICULE -->
    <div class="col-lg-6">

        <div class="card shadow-sm p-4">

            <h2 class="mb-2">
                <?= htmlspecialchars($vehicle['marque']) ?>
                <?= htmlspecialchars($vehicle['model']) ?>
            </h2>

            <p class="text-muted">
                <?= nl2br(htmlspecialchars($vehicle['description'])) ?>
            </p>

            <h4 class="text-primary mb-3">
                <?= number_format($vehicle['prix'], 2, ',', ' ') ?> € / jour
            </h4>

            <!-- Badge disponibilité (optionnel mais pro) -->
            <?php if (!empty($vehicle['disponibilite'])): ?>
                <span class="badge bg-success mb-3">Disponible</span>
            <?php else: ?>
                <span class="badge bg-danger mb-3">Indisponible</span>
            <?php endif; ?>

            <!-- Bouton vers formulaire -->
            <a href="#reservation" class="btn btn-primary w-100 mt-2">
                Réserver ce véhicule
            </a>

        </div>

    </div>

    <!-- COLONNE DROITE : FORMULAIRE RESERVATION -->
    <div class="col-lg-6">

        <div id="reservation" class="card shadow-sm p-4">

            <h4 class="mb-3">Formulaire de réservation</h4>

            <form method="POST" action="/reservation">
    
            <input type="hidden" name="Id_vehicules" value="<?= $vehicle['Id_vehicules'] ?>">

                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Date de début</label>
                    <input type="date" name="date_debut" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date de fin</label>
                    <input type="date" name="date_fin" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    Confirmer la réservation
                </button>

            </form>

        </div>

    </div>

</div>

<?php require ROOT . '/views/layouts/footer.php'; ?>