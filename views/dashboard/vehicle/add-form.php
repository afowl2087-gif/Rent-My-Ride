<?php require ROOT . '/views/layouts/dashboard-header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Ajouter un véhicule</h1>
    <a href="/dashboard/vehicle/list" class="btn btn-outline-secondary">
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

<div class="card shadow-sm" style="max-width: 700px;">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-12">
    <label class="form-label">Photo du véhicule</label>
    <input type="file"
           name="image"
           class="form-control"
           accept=".jpg,.jpeg,.png,.webp">
</div>
                <div class="col-md-6">
                    <label class="form-label">Marque</label>
                    <input type="text" name="marque" class="form-control"
                           value="<?= htmlspecialchars($data['marque']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Modèle</label>
                    <input type="text" name="model" class="form-control"
                           value="<?= htmlspecialchars($data['model']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nom commercial</label>
                    <input type="text" name="nom" class="form-control"
                           value="<?= htmlspecialchars($data['nom']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Prix / jour (€)</label>
                    <input type="number" name="prix" class="form-control" step="0.01" min="0"
                           value="<?= htmlspecialchars($data['prix']) ?>" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($data['description']) ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Catégorie</label>
                    <select name="Id_categories" class="form-select" required>
                        <option value="">-- Choisir --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['Id_categories'] ?>"
                                <?= $data['Id_categories'] == $cat['Id_categories'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['nom_categorie']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="disponibilite"
                               id="disponibilite" value="1"
                               <?= $data['disponibilite'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="disponibilite">Disponible à la location</label>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i> Ajouter
                </button>
                <a href="/dashboard/vehicle/list" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<?php require ROOT . '/views/layouts/dashboard-footer.php'; ?>