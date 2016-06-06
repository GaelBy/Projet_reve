<?php

if(isset($_SESSION['login']))
{

	$panier = new PanierManager($link);

	$id = $_SESSION['login'];


	$panier_unic = $panier->getById($id);

	$list = $panier_uni ->getProduits();

	$i = 0;

	while ($i < sizeof($list))
	{
		$produit = $list[$i];
		require('views/ls_produits_panier.phtml');
		$i++;
	}

}
?>