<?php
$count = 0 ;
$prod_list = $panier->getProduits();
$lengt = sizeof($prod_list);
while($count < $lengt)
{

	$prod_panier = $prod_list[$count];
	require('views/panier_item.phtml');
    $count ++ ;
}

?>