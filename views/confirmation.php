<?php require __DIR__ . '/layouts/header.php'; ?>

<div class="d-flex flex-column align-items-center justify-content-center py-5 text-center">

    <div class="mb-4" style="font-size:5rem;color:#28a745">
        <i class="bi bi-check-circle-fill"></i>
    </div>

    <h1 class="fw-bold mb-2">Réservation confirmée !</h1>
    <p class="text-muted mb-1">Votre demande a bien été enregistrée.</p>

    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="alert alert-<?= $_SESSION['flash']['type'] === 'success' ? 'success' : 'warning' ?> mt-3" style="max-width:500px">
            <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <p class="text-muted mt-3 mb-4" style="max-width:450px">
        Votre réservation est en attente de confirmation. Nous vous contacterons par e-mail dès que possible.
    </p>

    <a href="/" class="btn btn-danger btn-lg px-5">
        <i class="bi bi-arrow-left me-2"></i> Retour aux véhicules
    </a>

</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>
