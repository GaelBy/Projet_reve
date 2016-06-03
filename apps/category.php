<?php
$manager = new CategoryManager ($link);
$category = $manager->getById($_GET['id']);
require('views/category.phtml');
?>