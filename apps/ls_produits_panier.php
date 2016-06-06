<?php
if (isset($_SESSION['panier']) && $manager->getById($_SESSION['panier'])->getNombreProduits() != 0)
{
	$list = $panier->getProduits();
	$i = 0;
	while ($i < sizeof($list))
	{
		$produit = $list[$i];
		require('views/ls_produits_panier.phtml');
		$i++;
	}
}
?>