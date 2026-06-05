<?php
require_once ROOT . '/models/category.php';

$category   = new Category();
$categories = $category->getAll();

$pageTitle = 'Catégories';
require ROOT . '/views/dashboard/categories/list-categories.php';