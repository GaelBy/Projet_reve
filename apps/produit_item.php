<?php

if(isset(['id']))
{
	$id = $_POST['id'];

	$uni_prod = new ProduitsManager($link);

	$prod = $uni_prod->getById($id);


    require('views/produit_item.phtml');

}
?>