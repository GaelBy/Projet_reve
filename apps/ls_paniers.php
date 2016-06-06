


<?php




if(isset($_SESSION['id']))
{

		$user = new UserManager($link);

		$user_uni = $user->getById($id);

        $paniers = $user_uni->getPanier();

        $countPanier = 0;
			while ($countPanier < sizeof($paniers))
			{
				$panier = $paniers[$countPanier];
				
				$count = 0 ;
				$prod_list = $panier->getProduits();
				$lengt = count($prod_list);
				while($count < $lengt)
				{

					$prod_panier = $prod_list[$count];

			        

			       
					$count ++ ;
				}
				$countPanier++;
			    require('views/ls_paniers.phtml');
				require('apps/panier_item.php');
			}
}




?>