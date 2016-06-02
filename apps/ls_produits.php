<?php
$array_produit = $subcategory->getProduits();
// $res_sub = new ProduitsManager($link);
// $_id_sub = $_GET['id'];/*$_GET['id_category'];*/
// $array_produit = $res_sub->getBySubCategory($_id_sub);
$iSub = 0 ;
$nbSub = count( $array_produit );
while($iSub < $nbSub)
{
	$produit = $array_produit[$iSub];
	require('views/ls_produits.phtml');
	$iSub++;
}
?>