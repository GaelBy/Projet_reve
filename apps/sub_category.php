<?php
if(isset($_GET['id_sub_category']))
{
	$manager = new SubCategoryManager($link);
	$subcategory = $manager->getById($_GET['id_sub_category']);

	//$admin = 'hide';
	//if (isset($_SESSION['admin']) && $_SESSION['admin'])
		//$admin = '';
	//require('views/sub_category.phtml');


	$array_produit = $subcategory->getProduits();
// $res_sub = new ProduitsManager($link);
// $_id_sub = $_GET['id'];/*$_GET['id_category'];*/
// $array_produit = $res_sub->getBySubCategory($_id_sub);
		$iSub = 0 ;
		$nbSub = count( $array_produit );
		while($iSub < $nbSub)
		{
			$produit = $array_produit[$iSub];
			if ($produit->getStatut())
				require('views/sub_category.phtml');

			$iSub++;
		}
 //require('apps/produit_item.php');

	}
?>