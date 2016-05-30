<?php
if(isset($_SESSION['login']))
{
	$option_prod = new ProduitsManager($link);
	if (isset($_GET['action']) && $_GET['action'] == "creer" )
	{
		try
	    {
	    	$produit = $option_prod ->create($_POST);
	    	header('Location:index.php?page=produits');
	    	exit;
		}
	    catch (Exception $e);
	    {
	    	$error = $e->getMessage;
	    }
	}
	else if(isset($_GET['action']) && $_GET['action'] == "modifier")
	{
		try
		{
		    $option_prod ->update($this);
		    header('Location:index.php?page=produits');
		    exit;
		}
		catch (Exception $e);
		{
			$error = $e->getMessage;
		}
	}
	else if(isset($_GET['action']) && $_GET['action'] == "supprimer")
	{

		try
		{

		    $option_prod ->delete($this);
		    header('Location:index.php?page=produits');
		    exit;
		}
		catch (Exception $e);
		{
			$error = $e->getMessage;
		}
	}
}
?>