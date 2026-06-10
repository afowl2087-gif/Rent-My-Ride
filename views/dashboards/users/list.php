<?php require __DIR__ . '/../../../views/layouts/dashboard-header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Utilisateurs</h1>
    <a href="/controllers/dashboard/users/addController.php" class="btn btn-primary">
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

<?php if (empty($users)): ?>
    <p class="text-muted">Aucun utilisateur enregistré.</p>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>E-mail</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u['Id_users'] ?></td>
                    <td><?= htmlspecialchars($u['prenom'] . ' ' . $u['nom']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['telephone']) ?></td>
                    <td>
                        <?php if ($u['role'] == 1): ?>
                            <span class="badge bg-danger">Admin</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Client</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <a href="/controllers/dashboard/users/updateController.php?id=<?= $u['Id_users'] ?>"
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <a href="/controllers/dashboard/users/archiveController.php?id=<?= $u['Id_users'] ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Archiver cet utilisateur ?')">
                            <i class="bi bi-trash"></i> Archiver
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/../../../views/layouts/dashboard-footer.php'; ?>