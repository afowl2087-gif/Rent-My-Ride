<?php
session_start();

require_once __DIR__ . '/../config/database.php';

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $db = new Database();
        $pdo = $db->getConnection();
    }
    return $pdo;
}

require '../controllers/public/homeController.php';