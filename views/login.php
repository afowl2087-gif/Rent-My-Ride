<?php require ROOT . '/views/layouts/header.php'; ?>

<div class="container mt-5" style="max-width:500px">

    <h2 class="mb-4">Connexion Administrateur</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <div><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">
            <label>Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label>Mot de passe</label>
            <input
                type="password"
                name="password"
                class="form-control"
                required>
        </div>

        <button class="btn btn-primary w-100">
            Connexion
        </button>

    </form>

</div>

<?php require ROOT . '/views/layouts/footer.php'; ?>