
<?php
/*if(isset($_SESSION['id']))
{*/
	$manager = new UserManager($link);
	$id= 1 /*$_SESSION['id']*/; 
	$user = $manager->getById($id);
	require('views/profil_user.phtml');
/*}**/
?>