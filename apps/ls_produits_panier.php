<?php
$no_panier = '';
$panier_vide = 'hide';
$prix = 0;
$poids = 0;
$manager = new PanierManager($link);
if (!isset($_SESSION['panier']) || $manager->getById($_SESSION['panier'])->getNombreProduits() == 0)
{
	$no_panier = 'hide';
	$panier_vide = '';
}
else
{
	$panier = $manager->getById($_SESSION['panier']);
	$list = $panier->getProduits();
	$i = 0;
	var_dump($panier);
	while ($i < sizeof($list))
	{
		$produit = $list[$i];
		require('views/ls_produits_panier.phtml');
		$i++;
	}
	$prix = $panier->getPrix();
	$poids = $panier->getPoids();
}
?>