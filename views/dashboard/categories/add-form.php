<?php require ROOT . '/views/layouts/dashboard-header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Ajouter une catégorie</h1>
    <a href="/dashboard/categories/list" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card shadow-sm" style="max-width: 500px;">
    <div class="card-body">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nom_categorie" class="form-label fw-semibold">
                    Nom de la catégorie
                </label>
                <input type="text"
                       id="nom_categorie"
                       name="nom_categorie"
                       class="form-control"
                       value="<?= htmlspecialchars($nom) ?>"
                       required autofocus>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i> Ajouter
                </button>
                <a href="/dashboard/categories/list" class="btn btn-outline-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<?php require ROOT . '/views/layouts/dashboard-footer.php'; ?>