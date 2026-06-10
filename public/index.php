<?php
declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);

if (php_sapi_name() === 'cli-server') {
    $file = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($file)) return false;
}

define('ROOT', dirname(__DIR__));
require_once __DIR__ . '/../config/database.php';

function getDB(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $pdo = (new Database())->getConnection();
    }
    return $pdo;
}

session_start();

header('Location: /controllers/public/homeController.php');
exit;