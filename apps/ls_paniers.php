


<?php




if(isset($_SESSION['id']))
{

	$panier = new PanierManager($link);
require('views/ls_paniers.phtml');

	$id = $_SESSION['id']; 


	$articles = $panier->getByIdUser($id);
  

	$prod = 0 ;
    $nbr_panier = count( $articles);
		while($prod < $nbr_panier)
		{
			$panier_unit = $articles[$prod];
			require('apps/panier_item.php');
			$prod++;
		}

	

}


?>