<?php require __DIR__ . '/layouts/header.php'; ?>

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-<?= $_SESSION['flash']['type'] === 'success' ? 'success' : 'warning' ?> alert-dismissible fade show">
        <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="mb-3">
    <a href="/" class="text-decoration-none text-muted small"><i class="bi bi-arrow-left me-1"></i>Retour aux véhicules</a>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="rounded-4 overflow-hidden"
             style="height:360px;background:linear-gradient(135deg,#1a1a2e,#16213e);display:flex;align-items:center;justify-content:center;">
            <?php if (!empty($vehicle['image'])): ?>
                <img src="/public/<?= htmlspecialchars($vehicle['image']) ?>"
                     alt="<?= htmlspecialchars($vehicle['marque']) ?>"
                     style="width:100%;height:100%;object-fit:cover;">
            <?php else: ?>
                <i class="bi bi-car-front-fill text-white" style="font-size:6rem;opacity:.3"></i>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-lg-6">
        <?php if (!empty($vehicle['nom_categorie'])): ?>
            <span class="badge bg-secondary mb-2"><?= htmlspecialchars($vehicle['nom_categorie']) ?></span>
        <?php endif; ?>

        <h1 class="fw-bold mb-1">
            <?= htmlspecialchars($vehicle['marque']) ?> <?= htmlspecialchars($vehicle['model']) ?>
        </h1>
        <p class="text-muted mb-3"><?= htmlspecialchars($vehicle['nom']) ?></p>

        <?php if (!empty($vehicle['description'])): ?>
            <p class="mb-4"><?= nl2br(htmlspecialchars($vehicle['description'])) ?></p>
        <?php endif; ?>

        <div class="d-flex align-items-center gap-3 mb-4">
            <span style="font-size:2rem;font-weight:700;color:#e94560">
                <?= number_format((float)$vehicle['prix'], 2, ',', ' ') ?> €
                <small class="text-muted fw-normal fs-6">/jour</small>
            </span>
            <?php if ($vehicle['disponibilite']): ?>
                <span class="badge bg-success fs-6">Disponible</span>
            <?php else: ?>
                <span class="badge bg-danger fs-6">Indisponible</span>
            <?php endif; ?>
        </div>

        <?php if ($vehicle['disponibilite']): ?>
            <a href="/controllers/public/reservationController.php?id=<?= $vehicle['Id_vehicules'] ?>"
               class="btn btn-danger btn-lg px-5">
                <i class="bi bi-calendar-check me-2"></i>Réserver ce véhicule
            </a>
        <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>
