


<?php




if(isset($_SESSION['id']))
{

	$panier = new PanierManager($link);

	$id = $_SESSION['id']; 


	$articles = $panier->getByIdUser($id);
  

	$prod = 0 ;
    $nbr_panier = count( $articles);
		while($prod < $nbr_panier)
		{
			$panier_unit = $articles[$prod];

			var_dump($panier_unit);
			require('views/ls_paniers.phtml');
			$prod++;
		}

	

}


?>