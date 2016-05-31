<?php
<<<<<<< HEAD
if (isset($_SESSION['login']))
=======
if (isset($_SESSION['id']))
>>>>>>> 0c19215c5b5612d23bdb8f73ecc00d26558ae18d
{

	if ($_SESSION['admin'] == 1)
	{
		require('views/sidebar_admin.phtml');
	}
	 	
	else 
	{
		require('views/sidebar_user.phtml');
	}
}
else
{
	require('views/sidebar.phtml');
}

?>