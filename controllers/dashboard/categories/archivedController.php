<?php

require_once ROOT . '/models/category.php';

$category = new Category();
$categories = $category->getArchived();

$pageTitle = "Catégories archivées";
require ROOT . '/views/dashboard/categories/archived.php';