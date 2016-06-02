

<?php


if(isset($_SESSION['id']))
{

	$panier = new PanierManager($link);

	$id = $_SESSION['id']; 


	$articles = $panier->getProduits($id);

	$prod = 0 ;
	$prod_panier = count( $articles );
	while($prod < $articles)
	{
		$client_prod = $articles[$prod];
		require('views/ls_produits.phtml');
		$iSub++;
	}


}	



	








}

?>