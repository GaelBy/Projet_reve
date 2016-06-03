
<?php
if(isset($_SESSION['id']))
{
	$manager = new UserManager($link);
	$id= $_SESSION['id']; 
	$user = $manager->getById($id);
	require('views/profil_user.phtml');
}
?>