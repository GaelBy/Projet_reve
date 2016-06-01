<?php

if(isset($_SESSION['id']))
{

	$client = new UserManager($link);

	$id= $_SESSION['id']; 


	$client_res = $client->getById($id);

    require('views/ls_paniers.phtml');




}

?>