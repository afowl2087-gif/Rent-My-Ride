<?php
require_once __DIR__ . '/../../../models/category.php';

$category   = new Category();
$categories = $category->getAll();

$pageTitle = 'Catégories';
require __DIR__ . '/../../../views/dashboard/categories/list-categories.php';