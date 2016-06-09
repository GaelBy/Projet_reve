<?php
$manager = new CategoryManager ($link);
if (isset($_GET['id']))
{
	$category = $manager->getById($_GET['id']);
	$admin='hide';
	if(isset($_SESSION['admin'])&&$_SESSION['admin'])
	{
		$admin="";
	}
	if (!empty($category))
		require('views/category.phtml');
	else
		require('views/home.phtml');
}
?>