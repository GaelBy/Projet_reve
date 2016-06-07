


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
	    		require('views/ls_paniers.phtml');
				$countPanier++;
			}
}




?>