<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config/database.php';

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $pdo = (new Database())->getConnection();
    }
    return $pdo;
}
function requireAdmin(): void {
    if (empty($_SESSION['is_admin'])) {
        header('Location: /controllers/public/adminLoginController.php');
        exit;
    }
}
