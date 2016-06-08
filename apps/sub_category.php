<?php
if(isset($_GET['id_sub_category']))
{
	$manager = new SubCategoryManager($link);
	$subcategory = $manager->getById($_GET['id_sub_category']);


	$array_produit = $subcategory->getProduits();
$iSub = 0 ;
$nbSub = count( $array_produit );
while($iSub < $nbSub)
{
	$produit = $array_produit[$iSub];
	if ($produit->getStatut())
		require('views/sub_category.phtml');
	    
	$iSub++;
}
 
}

?>