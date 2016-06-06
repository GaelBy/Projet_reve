<?php
if (isset($_SESSION['id'], $_POST['id_produit']))
{
	$produit_manager = new ProduitsManager($link);
	$user_manager = new UserManager($link);
	$avis_manager = new AvisManager($link);
	if (isset($_GET['action']) && $_GET['action'] == "creer" )		
	{
		try
		{
			$produit = $produit_manager->getById($_POST['id_produit']);
			$user = $user_manager->getById($_SESSION['id']);
			$avis = $avis_manager->create($_POST, $produit, $user);
			//$date_avis = date('Y-m-d H:m:i');
			//$query = "INSERT INTO avis (id_author, content, id_produit, note) VALUES ('".$id_author."', '".$content ."', '".$id_produit."', '".$note."')";
			// $res = mysqli_query( $link, $query);
			header('Location: ?page=produit&id_produit='.$produit->getId());
			exit;
		}
		catch (Exception $e)
    	{
    		$error = $e->getMessage();
    	}
	}
	else if(isset($_GET['action']) && $_GET['action'] == "modifier")
	{
		try
		{
			$avis = $avis_manager->getById($_POST['id_avis']);
			if ($avis->getAuthor()->getId() == $_SESSION['id'])
			{
				if (isset($_POST['content']))
					$avis->setContent($_POST['content']);
				else
					throw new Exception("Paramètre manquant : contenu");
				if (isset($_POST['note']))
					$avis->setNote($_POST['note']);
				else
					throw new Exception("Paramètre manquant : note");
				$avis = $avis_manager->update($avis);
				header('Location: ?page=produit&id_produit='.$produit->getId());
				exit;
			}
		}

		catch (Exception $e)
    	{
    		$error = $e->getMessage();
    	}

	}

	else if(isset($_GET['action']) && $_GET['action'] == "supprimer")
	{
		try
		{
			$avis = $avis_manager->getById($_GET['id_avis']);
			if (isset($_SESSION['admin']) && $_SESSION['admin'])
			{
				$avis = $avis_manager->delete($avis);
				header('Location: ?page=produit&id_produit='.$produit->getId());
				exit;
			}
		}
		catch (Exception $e)
	    {
	    	$error = $e->getMessage();
	    }
	}
}
?>