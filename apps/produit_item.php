<?php

if(isset($_GET['id']))
{
	$id = $_POST['id'];

	$uni_prod = new ProduitsManager($link);

	$prod = $uni_prod->getById($id);


    require('views/produit_item.phtml');

}
?>