<?php
if(isset($_GET['id_sub_category']))
{
	$manager = new SubCategoryManager($link);
	$subcategory = $manager->getById($_GET['id_sub_category']);
	$array_produit = $subcategory->getProduits();
	$admin='hide';
	
	if(isset($_SESSION['admin'])&& $_SESSION['admin'])
	{
		$admin="";
	}
	require('views/sub_category.phtml');
}
?>