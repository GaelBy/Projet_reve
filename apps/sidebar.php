<?php
if (isset($_SESSION['id']))
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