<?php
if (isset($_SESSION['admin']) && $_SESSION['admin'])
{
	if (isset($_GET['action']) && $_GET['action'] == 'create')
	{
		$produit = new Produits($link);
		$action = 'ajouter';
	}
	if (isset($_GET['action'], $_GET['id_produit']) && $_GET['action'] == 'edit')
	{
		$manager = new ProduitsManager($link);
		$produit = $manager->getById($_GET['id_produit']);
		$action = 'modifier';
	}
	require('views/admin_produits.phtml');
}

?>