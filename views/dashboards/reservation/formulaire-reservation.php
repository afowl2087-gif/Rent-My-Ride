<?php require __DIR__ . '/../../../views/layouts/header.php'; ?>

<div class="container py-5" style="max-width: 700px;">

    <div class="mb-4">
        <a href="/controllers/public/detailController.php?id=<?= $vehicle['Id_vehicules'] ?>" class="text-decoration-none">
            <i class="bi bi-arrow-left"></i> Retour à la fiche
        </a>
    </div>

    <h1 class="h3 mb-1">Réserver</h1>
    <p class="text-muted mb-4">
        <?= htmlspecialchars($vehicle['marque'] . ' ' . $vehicle['model']) ?>
        — <strong><?= number_format((float)$vehicle['prix'], 2, ',', ' ') ?> € / jour</strong>
    </p>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="">

                <h5 class="mb-3">Vos coordonnées</h5>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control"
                               value="<?= htmlspecialchars($data['nom']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control"
                               value="<?= htmlspecialchars($data['prenom']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control"
                               value="<?= htmlspecialchars($data['email']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" name="telephone" class="form-control"
                               value="<?= htmlspecialchars($data['telephone']) ?>">
                    </div>
                </div>

                <h5 class="mb-3">Période de location</h5>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Date de début</label>
                        <input type="date" name="date_debut" class="form-control"
                               value="<?= htmlspecialchars($data['date_debut']) ?>"
                               min="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date de fin</label>
                        <input type="date" name="date_fin" class="form-control"
                               value="<?= htmlspecialchars($data['date_fin']) ?>"
                               min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
                    </div>
                </div>

                <div id="recap" class="alert alert-info d-none mb-4">
                    <i class="bi bi-calculator"></i>
                    <span id="recap-text"></span>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100">
                    <i class="bi bi-calendar-check"></i> Confirmer la réservation
                </button>

            </form>
        </div>
    </div>
</div>

<script>
const prix      = <?= (float) $vehicle['prix'] ?>;
const inDebut   = document.querySelector('[name="date_debut"]');
const inFin     = document.querySelector('[name="date_fin"]');
const recap     = document.getElementById('recap');
const recapText = document.getElementById('recap-text');

function calculer() {
    if (!inDebut.value || !inFin.value) return;
    const d1    = new Date(inDebut.value);
    const d2    = new Date(inFin.value);
    const jours = Math.round((d2 - d1) / 86400000);
    if (jours > 0) {
        const total = (jours * prix).toFixed(2).replace('.', ',');
        recapText.textContent =
            jours + ' jour(s) × ' + prix.toFixed(2).replace('.', ',') + ' € = ' + total + ' €';
        recap.classList.remove('d-none');
    } else {
        recap.classList.add('d-none');
    }
}

inDebut.addEventListener('change', calculer);
inFin.addEventListener('change', calculer);
</script>

<?php require __DIR__ . '/../../../views/layouts/footer.php'; ?>