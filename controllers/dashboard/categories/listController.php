<?php
require_once __DIR__ . '/../../../bootstrap.php';
require_once __DIR__ . '/../../../models/category.php';

$categories = (new Category())->getAll();

$pageTitle = 'Catégories';
require __DIR__ . '/../../../views/dashboards/categories/list-categories.php';
