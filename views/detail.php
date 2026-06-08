<?php require __DIR__ . '/../views/layouts/header.php'; ?>

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
             style="height:360px;background:linear-gradient(135 **...**

