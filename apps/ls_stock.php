<?php
$count=0;
$manager = new ProduitsManager ($link);
$lsProduits = $manager->getAll();

while($count<sizeof($lsProduits))
{
	$produit = $lsProduits[$count];
	require('views/ls_stock.phtml');
	$count++;
}
?>