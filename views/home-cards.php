<?php require ROOT . '/views/layouts/header.php'; ?>

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-<?= $_SESSION['flash']['type'] === 'success' ? 'success' : 'warning' ?> alert-dismissible fade show">
        <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<!-- Hero -->
<div class="rounded-4 p-5 mb-4 text-white"
     style="background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460)">
    <h1 class="fw-bold display-5 mb-2">Louez le véhicule idéal</h1>
    <p class="lead text-white-50 mb-4">Simple, rapide, sans engagement.</p>
    <form method="GET" action="/" class="d-flex gap-2 flex-wrap">
        <?php if ($categoryId): ?><input type="hidden" name="cat" value="<?= $categoryId ?>"><?php endif; ?>
        <input type="text" name="q" value="<?= htmlspecialchars($search) ?>"
               class="form-control flex-grow-1" style="max-width:400px"
               placeholder="Marque, modèle, description…">
        <button type="submit" class="btn btn-danger px-4">Rechercher</button>
        <?php if ($search || $categoryId): ?>
            <a href="/" class="btn btn-outline-light">Réinitialiser</a>
        <?php endif; ?>
    </form>
</div>

<!-- Filtres catégories -->
<?php if (!empty($categories)): ?>
<div class="d-flex flex-wrap gap-2 mb-4">
    <a href="/?<?= $search ? 'q='.urlencode($search) : '' ?>"
       class="btn btn-sm <?= !$categoryId ? 'btn-danger' : 'btn-outline-secondary' ?> rounded-pill">Tous</a>
    <?php foreach ($categories as $cat): ?>
    <a href="/?cat=<?= $cat['Id_categories'] ?><?= $search ? '&q='.urlencode($search) : '' ?>"
       class="btn btn-sm <?= (int)$categoryId === (int)$cat['Id_categories'] ? 'btn-danger' : 'btn-outline-secondary' ?> rounded-pill">
        <?= htmlspecialchars($cat['nom_categorie']) ?>
    </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<p class="text-muted small mb-3"><?= $total ?> véhicule<?= $total > 1 ? 's' : '' ?> disponible<?= $total > 1 ? 's' : '' ?></p>

<?php if (empty($vehicles)): ?>
    <div class="text-center py-5 text-muted">
        <i class="bi bi-search" style="font-size:3rem;opacity:.3"></i>
        <p class="mt-3">Aucun véhicule ne correspond.</p>
        <a href="/" class="btn btn-danger btn-sm">Voir tous les véhicules</a>
    </div>
<?php else: ?>
<div class="row g-4 mb-4">
    <?php foreach ($vehicles as $v): ?>
    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="card h-100" style="border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.07)">
            <!-- Placeholder image -->
            <div style="height:180px;background:linear-gradient(135deg,#1a1a2e,#0f3460);display:flex;align-items:center;justify-content:center">
                <i class="bi bi-car-front-fill text-white" style="font-size:4rem;opacity:.3"></i>
            </div>
            <div class="card-body d-flex flex-column">
                <?php if (!empty($v['nom_categorie'])): ?>
                    <span class="badge bg-secondary mb-2" style="width:fit-content"><?= htmlspecialchars($v['nom_categorie']) ?></span>
                <?php endif; ?>
                <h5 class="card-title mb-1"><?= htmlspecialchars($v['marque']) ?> <?= htmlspecialchars($v['model']) ?></h5>
                <small class="text-muted mb-2"><?= htmlspecialchars($v['nom']) ?></small>
                <?php if (!empty($v['description'])): ?>
                    <p class="card-text small text-muted flex-grow-1">
                        <?= htmlspecialchars(mb_substr($v['description'], 0, 80)) ?>…
                    </p>
                <?php endif; ?>
                <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                    <span style="font-size:1.2rem;font-weight:700;color:#e94560">
                        <?= number_format((float)$v['prix'], 2, ',', ' ') ?> €
                        <small class="text-muted fw-normal fs-6">/jour</small>
                    </span>
                    <a href="/vehicle/detail?id=<?= $v['Id_vehicules'] ?>" class="btn btn-sm btn-danger">Voir</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Pagination -->
<?php if ($totalPages > 1): ?>
<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page-1 ?><?= $categoryId ? '&cat='.$categoryId : '' ?><?= $search ? '&q='.urlencode($search) : '' ?>">
                <i class="bi bi-chevron-left"></i>
            </a>
        </li>
        <?php for ($i = max(1,$page-2); $i <= min($totalPages,$page+2); $i++): ?>
        <li class="page-item <?= $i===$page ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?><?= $categoryId ? '&cat='.$categoryId : '' ?><?= $search ? '&q='.urlencode($search) : '' ?>">
                <?= $i ?>
            </a>
        </li>
        <?php endfor; ?>
        <li class="page-item <?= $page>=$totalPages ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page+1 ?><?= $categoryId ? '&cat='.$categoryId : '' ?><?= $search ? '&q='.urlencode($search) : '' ?>">
                <i class="bi bi-chevron-right"></i>
            </a>
        </li>
    </ul>
</nav>
<?php endif; ?>
<?php endif; ?>

<?php require ROOT . '/views/layouts/footer.php'; ?>