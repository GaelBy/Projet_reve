<?php
if (isset($_SESSION['admin']) && $_SESSION['admin'])
{
	$http = '';
	if (isset($_GET['action']) && $_GET['action'] == 'create')
	{
		$produit = new Produits($link);
		$action = 'ajouter';
		$subcat = new SubCategory($link);
		$produit->setSubCategory($subcat);
	}
	if (isset($_GET['action'], $_GET['id_produit']) && $_GET['action'] == 'edit')
	{
		$manager = new ProduitsManager($link);
		$produit = $manager->getById($_GET['id_produit']);
		$action = 'modifier';
		if (!strpos($produit->getImage(), 'http://'))
			$http = 'http://localhost/projet_reve';
	}
	require('views/admin_produits.phtml');
}

?>