<?php
var_dump($_POST);
if(isset($_SESSION['admin']))
{
	$option_prod = new ProduitsManager($link);
	if(isset($_POST['action']) && $_POST['action'] == "ajouter")
	//if (isset($_POST['id_sub_category']) && $_POST['reference']&& $_POST['stock']&& $_POST['prix_uni_ht']&& $_POST['tva']
	//	&& $_POST['description']&& $_POST['image']&& $_POST['nom']&& $_POST['poids_uni']&& $_POST[''])
	{
		try
	    {
	    	$option_prod ->create($_POST);
	    	header('Location:index.php?page=produits');
	    	exit;
		}
	    catch (Exception $e)
	    {
	    	$error = $e->getMessage();
	    }
	}
	else if(isset($_POST['action']) && $_POST['action'] == "modifier")
	{
		try
		{

			$produit = $option_prod ->getById($_POST['id_produit']);
			$produit->setReference($_POST['reference']); 
			$produit->setStock($_POST['stock']);
			$produit->setPrixUniHt($_POST['prix_unitaire']);
			$produit->setTva($_POST['tva']);
			$produit->setPrixUniTtc();
			$produit->setDescription($_POST['description']);
			$produit->setImage($_POST['image']);
			$produit->setNom($_POST['nom']);
			$produit->setPoidsUni($_POST['poids_uni']);
			$produit->setStatut($_POST['statut']);
			$produit->update($this);
		    header('Location:index.php?page=admin_produits');
		    exit;
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
            $produit = $option_prod ->getById($_GET['id_produit']);
		    $option_prod->delete($produit);
		    header('Location:index.php?page=produits');
		    exit;
		}
		catch (Exception $e)
		{
			$error = $e->getMessage();
		}
	}
}
?>