<?php require ROOT . '/views/layouts/dashboard-header.php'; ?>

<div class="container mt-4">

<h2>Modifier catégorie</h2>

<form method="POST">
    <input type="text"
           name="nom_categorie"
           class="form-control"
           value="<?= htmlspecialchars($category['nom_categorie']) ?>">

    <button class="btn btn-primary mt-3">Modifier</button>
</form>

</div>

<?php require ROOT . '/views/layouts/dashboard-footer.php'; ?>