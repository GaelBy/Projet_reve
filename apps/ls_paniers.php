


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
if(isset($_GET['action']))
{
	                    $panier_user = new  PanierManager($link);
	                    $panier_sup = $panier_user->getByIdUser($id);
	                    ,$count=0;
	                    $length = count($panier_sup);
	                    while($count < $length)
	                    {
	                        $sup = $panier_sup[$count];



	                       //$sup->delete();

	              
	                       
	                        $count++;
	                    }

	                    require('views/ls_paniers.phtml');
}






?>