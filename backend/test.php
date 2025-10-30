<?php
require_once 'dao/CategoriesDao.php';

$categoriesDao = new CategoriesDao();

$categories = $categoriesDao->getAll();
print_r($categories);
?>