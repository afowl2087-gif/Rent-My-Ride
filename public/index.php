<?php
declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Servir les fichiers statiques (images, css, js) avec le serveur CLI PHP
if (php_sapi_name() === 'cli-server') {
    $file = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($file)) return false;
}

define('ROOT', dirname(__DIR__));

require_once __DIR__ . '/../config/database.php';

// Singleton PDO accessible partout via getDB()
function getDB(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $pdo = (new Database())->getConnection();
    }
    return $pdo;
}

session_start();

$uri      = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = array_values(array_filter(explode('/', $uri)));

if (empty($segments)) {
    require __DIR__ . '/../controllers/public/homeController.php';

} elseif ($segments[0] === 'dashboard') {
    $section = $segments[1] ?? 'categories';
    $action  = $segments[2] ?? 'list';
    $ctrl    = __DIR__ . "/../controllers/dashboard/{$section}/{$action}Controller.php";
    if (file_exists($ctrl)) {
        require $ctrl;
    } else {
        http_response_code(404);
        echo '<h1>404 – Page introuvable</h1>';
    }

} elseif ($segments[0] === 'vehicle') {
    $action = $segments[1] ?? 'detail';
    $ctrl   = __DIR__ . "/../controllers/public/{$action}Controller.php";
    if (file_exists($ctrl)) {
        require $ctrl;
    } else {
        http_response_code(404);
        echo '<h1>404 – Page introuvable</h1>';
    }

} else {
    $ctrl = __DIR__ . "/../controllers/public/{$segments[0]}Controller.php";
    if (file_exists($ctrl)) {
        require $ctrl;
    } else {
        http_response_code(404);
        echo '<h1>404 – Page introuvable</h1>';
    }
}
