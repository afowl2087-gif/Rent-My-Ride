<?php require ROOT . '/views/layouts/dashboard-header.php'; ?>

<h1 class="h3 mb-4">Catégories archivées</h1>

<a href="/dashboard/categories/list" class="btn btn-secondary mb-3">
    Retour aux catégories
</a>

<?php if (empty($categories)): ?>
    <p class="text-muted">Aucune catégorie archivée.</p>
<?php else: ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th class="text-end">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $cat): ?>
        <tr>
            <td><?= htmlspecialchars($cat['nom_categorie']) ?></td>
            <td class="text-end">
                <a href="/dashboard/categories/restore?id=<?= $cat['Id_categories'] ?>"
                   class="btn btn-sm btn-success">
                    Restaurer
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?php require ROOT . '/views/layouts/dashboard-footer.php'; ?>