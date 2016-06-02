<?php
$list = $panier->getProduits();
$i = 0;
while ($i < sizeof($list))
{
	$produit = $list[$i];
	require('views/ls_produits_panier.phtml');
	$i++;
}
?>