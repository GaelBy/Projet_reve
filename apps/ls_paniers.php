<?php




if(isset($_SESSION['id']))
{

	$panier = new PanierManager($link);

	$id = $_SESSION['id']; 


	$articles = $panier->getById($id)->getProduits();

	/*$prod = 0 ;
	$prod_panier = count( $articles );
	while($prod < $prod_panier)
	{
		$panier_prod= $articles[$prod];
		require('views/ls_panier.phtml');
		$iSub++;
	}*/


}	




?>