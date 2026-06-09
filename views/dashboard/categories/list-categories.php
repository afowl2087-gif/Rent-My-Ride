<?php require ROOT . '/views/layouts/dashboard-header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Catégories</h1>

    <div>
        <a href="/dashboard/categories/archived" class="btn btn-secondary me-2">
            <i class="bi bi-archive"></i> Catégories archivées
        </a>

        <a href="/dashboard/categories/add" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Ajouter
        </a>
    </div>
</div>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show">
        <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<?php if (empty($categories)): ?>
    <p class="text-muted">Aucune catégorie enregistrée.</p>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?= $cat['Id_categories'] ?></td>
                    <td><?= htmlspecialchars($cat['nom_categorie']) ?></td>
                    <td class="text-end">
                        <a href="/dashboard/categories/update?id=<?= $cat['Id_categories'] ?>"
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <a href="/dashboard/categories/archive?id=<?= $cat['Id_categories'] ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Archiver cette catégorie ?')">
                        <i class="bi bi-archive"></i> Archiver
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require ROOT . '/views/layouts/dashboard-footer.php'; ?>