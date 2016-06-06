<?php
if(isset($_SESSION['admin']))
{
	$option_prod = new ProduitsManager($link);
	if(isset($_POST['action']) && $_POST['action'] == "ajouter")
	//if (isset($_POST['id_sub_category']) && $_POST['reference']&& $_POST['stock']&& $_POST['prix_uni_ht']&& $_POST['tva']
	//	&& $_POST['description']&& $_POST['image']&& $_POST['nom']&& $_POST['poids_uni']&& $_POST[''])
	{
		try
	    {
	    	$produit = $option_prod ->create($_POST);
	    	header('Location:index.php?page=produit&id_produit='.$produit->getId());
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
			if (isset($_POST['reference']))
				$produit->setReference($_POST['reference']); 
			if (isset($_POST['stock']))
				$produit->setStock($_POST['stock']);
			if (isset($_POST['prix_unitaire_ht']))
				$produit->setPrixUniHt($_POST['prix_unitaire_ht']);
			if (isset($_POST['tva']))
				$produit->setTva($_POST['tva']);
			if (isset($_POST['prix_unitaire_ttc']))
				$produit->setPrixUniTtc($_POST['prix_unitaire_ttc']);
			if (isset($_POST['description']))
				$produit->setDescription($_POST['description']);
			if (isset($_POST['image']))
				$produit->setImage($_POST['image']);
			if (isset($_POST['nom']))
				$produit->setNom($_POST['nom']);
			if (isset($_POST['poids_uni']))
				$produit->setPoidsUni($_POST['poids_uni']);
			if (isset($_POST['statut']))
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
		    $produit->delete($this);
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