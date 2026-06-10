<?php require __DIR__ . '/../../../views/layouts/dashboard-header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Véhicules</h1>
    <a href="/controllers/dashboard/vehicle/addController.php" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Ajouter
    </a>
</div>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show">
        <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<?php if (empty($vehicles)): ?>
    <p class="text-muted">Aucun véhicule enregistré.</p>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Marque / Modèle</th>
                    <th>Nom commercial</th>
                    <th>Catégorie</th>
                    <th>Prix / jour</th>
                    <th>Disponible</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehicles as $v): ?>
                <tr>
                    <td><?= $v['Id_vehicules'] ?></td>
                    <td>
                        <strong><?= htmlspecialchars($v['marque']) ?></strong>
                        <?= htmlspecialchars($v['model']) ?>
                    </td>
                    <td><?= htmlspecialchars($v['nom']) ?></td>
                    <td><?= htmlspecialchars($v['nom_categorie'] ?? '—') ?></td>
                    <td><?= number_format((float)$v['prix'], 2, ',', ' ') ?> €</td>
                    <td>
                        <?php if ($v['disponibilite']): ?>
                            <span class="badge bg-success">Oui</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Non</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <a href="/controllers/dashboard/vehicle/updateController.php?id=<?= $v['Id_vehicules'] ?>"
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <a href="/controllers/dashboard/vehicle/deleteController.php?id=<?= $v['Id_vehicules'] ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Supprimer ce véhicule ?')">
                            <i class="bi bi-trash"></i> Supprimer
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/../../../views/layouts/dashboard-footer.php'; ?>