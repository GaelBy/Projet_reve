<<<<<<< HEAD
ls_panier.php

=======
>>>>>>> 77480c144f14e58d9c2979e7aa698d7733b4c22f
<?php
if(isset($_SESSION['id']))
{
	$manager = new UserManager($link);
	$id= $_SESSION['id']; 
	$user = $manager->getById($id);
	require('apps/profil_user.php');
}
?>