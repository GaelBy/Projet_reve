

<?php


/*if(isset($_SESSION['id']))
{*/

	$articles = new PanierManager($link);

	$id = 1 ; 


	$a = $articles->getById($id);


	







    require('views/panier_item.phtml');

/*}*/

?>