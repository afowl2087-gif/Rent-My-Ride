require_once ROOT . '/models/category.php';

$id = (int)($_GET['id'] ?? 0);
$category = (new Category())->findById($id);

if (!$category) {
    header('Location: /dashboard/categories/list');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom_categorie']);

    if (!empty($nom)) {
        (new Category())->update($id, $nom);
        $_SESSION['flash'] = [
            'type' => 'success',
            'msg' => 'Catégorie modifiée'
        ];
    }

    header('Location: /dashboard/categories/list');
    exit;
}

require ROOT . '/views/dashboard/categories/edit.php';