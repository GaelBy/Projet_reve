<?php
$manager = new CategoryManager ($link);
$category = $manager->getById($_GET['id']);
$admin='hide';
if(isset($_SESSION['admin'])&&$_SESSION['admin'])
{
	$admin="";
}
require('views/category.phtml');
?>