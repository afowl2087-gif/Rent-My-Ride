<?php require ROOT . '/views/layouts/dashboard-header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Réservations</h1>
</div>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show">
        <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<?php if (empty($reservations)): ?>
    <p class="text-muted">Aucune réservation enregistrée.</p>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Véhicule</th>
                    <th>Du</th>
                    <th>Au</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th class="text-end">Changer statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $r):
                    $debut = new DateTime($r['date_debut']);
                    $fin   = new DateTime($r['date_fin']);
                    $jours = (int) $debut->diff($fin)->days;
                    $total = number_format($jours * (float) $r['prix'], 2, ',', ' ');
                    $badge = match($r['statut']) {
                        'confirmée' => 'success',
                        'annulée'   => 'danger',
                        default     => 'warning',
                    };
                ?>
                <tr>
                    <td><?= $r['Id_reservations'] ?></td>
                    <td>
                        <strong><?= htmlspecialchars($r['prenom'] . ' ' . $r['nom']) ?></strong><br>
                        <small class="text-muted"><?= htmlspecialchars($r['email']) ?></small><br>
                        <small class="text-muted"><?= htmlspecialchars($r['telephone']) ?></small>
                    </td>
                    <td><?= htmlspecialchars($r['marque'] . ' ' . $r['model']) ?></td>
                    <td><?= $debut->format('d/m/Y') ?></td>
                    <td><?= $fin->format('d/m/Y') ?></td>
                    <td class="fw-semibold"><?= $total ?> €</td>
                    <td>
                        <span class="badge bg-<?= $badge ?>">
                            <?= htmlspecialchars($r['statut']) ?>
                        </span>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                    type="button" data-bs-toggle="dropdown">
                                Modifier
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item"
                                       href="/dashboard/reservation/list?id=<?= $r['Id_reservations'] ?>&statut=en+attente">
                                        <span class="text-warning">●</span> En attente
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                       href="/dashboard/reservation/list?id=<?= $r['Id_reservations'] ?>&statut=confirm%C3%A9e">
                                        <span class="text-success">●</span> Confirmée
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                       href="/dashboard/reservation/list?id=<?= $r['Id_reservations'] ?>&statut=annul%C3%A9e">
                                        <span class="text-danger">●</span> Annulée
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require ROOT . '/views/layouts/dashboard-footer.php'; ?>