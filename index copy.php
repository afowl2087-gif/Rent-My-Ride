<?php include __DIR__ . '/views/header.php'; ?>

<div class="container">

    <?php include __DIR__ . '/views/sidebar.php'; ?>

    <div class="main">

        <div class="top">
            <h1>Liste des utilisateurs</h1>
            <button class="btn-add">+ Ajouter</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                // faux data pour test
                $users = [
                    ["id" => 1, "nom" => "Jean Dupont", "email" => "jean@mail.com"],
                    ["id" => 2, "nom" => "Marie Martin", "email" => "marie@mail.com"]
                ];

                foreach ($users as $user) {
                    echo "<tr>
                        <td>{$user['id']}</td>
                        <td>{$user['nom']}</td>
                        <td>{$user['email']}</td>
                        <td>
                            <a class='view' href='#'>Voir</a>
                            <a class='edit' href='#'>Modifier</a>
                            <a class='delete' href='#'>Supprimer</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
</div>

<?php include __DIR__ . '/views/footer.php'; ?>