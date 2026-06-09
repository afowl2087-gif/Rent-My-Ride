<?php require ROOT . '/views/layouts/dashboard-header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Utilisateurs archivés</h1>

    <a href="/dashboard/users/list" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour
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
    <p class="text-muted">Aucun utilisateur archivé.</p>
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

                    <a href="/dashboard/users/restore?id=<?= $u['Id_users'] ?>"
                       class="btn btn-sm btn-success">
                        <i class="bi bi-arrow-counterclockwise"></i> Restaurer
                    </a>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php endif; ?>

<?php require ROOT . '/views/layouts/dashboard-footer.php'; ?>