<?php
$list = $panier->getProduits();
$i = 0;
while ($i < sizeof($list))
{
	$produit = $list[$i];
	require('views/admin_panier_item.phtml');
	$i++;
}

?>