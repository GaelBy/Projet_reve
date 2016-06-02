<?php


/*if(isset($_SESSION['id']))
{*/

	$articles = new PanierManager($link);

	$id = 1 ; 


	$a = $articles->getById($id);


	







    require('views/ls_paniers.phtml');

/*}*/

?>