<?php
if (!isset($_SESSION['login']))
{
	header('Location: ?page=login');
	exit;
}

	if (isset($_SESSION['id'], $_POST['content'], $_POST['id_produit'], $_POST['note']))
	{
		if (isset($_GET['action']) && $_GET['action'] == "creer" )		
		{
			try
			{
			$produit_manager = new ProduitManager($link);
			$user_manager = new UserManager($link);
			$avis_manager = new AvisManager($link);
			$produit = $produit_manager->getById($_POST['id_produit']);
			$user = $user_manager->getById($_SESSION['id']);
			$avis = $avis_manager->create($_POST, $produit, $user);
			//$date_avis = date('Y-m-d H:m:i');
			//$query = "INSERT INTO avis (id_author, content, id_produit, note) VALUES ('".$id_author."', '".$content ."', '".$id_produit."', '".$note."')";
			// $res = mysqli_query( $link, $query);
			header('Location: ?page=produit&id='.$produit->getId());
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
			$produit_manager = new ProduitManager($link);
			$user_manager = new UserManager($link);
			$avis_manager = new AvisManager($link);
			$produit = $produit_manager->getById($_POST['id_produit']);
			$user = $user_manager->getById($_SESSION['id']);
			$avis = $avis_manager->update($_POST, $produit, $user);
			header('Location: ?page=produit&id='.$produit->getId());
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
			$produit_manager = new ProduitManager($link);
			$user_manager = new UserManager($link);
			$avis_manager = new AvisManager($link);
			$produit = $produit_manager->getById($_POST['id_produit']);
			$user = $user_manager->getById($_SESSION['id']);
			$avis = $avis_manager->delete($_POST, $produit, $user);
			header('Location: ?page=produit&id='.$produit->getId());
			exit;
			}
			catch (Exception $e);
		    {
		    $error = $e->getMessage;
		    }
	}
}
?>