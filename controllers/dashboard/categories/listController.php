<?php
require_once __DIR__ . '/../../../models/category.php';

$categories = (new Category())->getAll();

$pageTitle = 'Catégories';
require __DIR__ . '/../../../views/dashboard/categories/list-categories.php';
