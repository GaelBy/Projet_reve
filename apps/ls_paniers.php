


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

                if(isset($_POST['supprimer']))
                {
                     $panier->delete($this);
                }
				
	    		require('views/ls_paniers.phtml');
				$countPanier++;
			}



}





?>