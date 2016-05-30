<?php
$produit_manager = new ProduitManager($link);
$panier_manager = new PanierManager($link);
try
{
	if (isset($_POST['id_produit']))
	{
		$produit = $produit_manager->getById($_POST['id_produit']);
		//add
		if (isset($_GET['page']) && $_GET['page'] == 'produit')
		{
			//create?
			if (!isset($_SESSION['panier']))
			{
				$panier = new Panier($link);
				$panier->ajoutProduit($produit);
				$data = array('id_user'=>0, 'statut'=>'en cours', 'prix'=>$panier->prix, 'nombre_produits'=>$panier->nombre_produits, 'poids'=>$panier->poids);
				if (!isset($_SESSION['id']))
					$data['id_user'] = $_SESSION['id'];
				$panier = $panier_manager->create($data);
				$_SESSION['panier'] = $panier->getId();
			}
			else
			{
				$panier = $panier_manager->getById($_SESSION['panier']);
				$panier->ajoutProduit($produit);
				$panier = $panier_manager->update($panier);
			}
		}
		else if (isset($_GET['page'], $_GET['action']) && $_GET['page'] == 'panier' && $_GET['action'] == 'remove')
		{
			//remove
			$panier = $panier_manager->getById($_SESSION['panier']);
			$panier->suppressionProduit($produit);
			$panier = $panier_manager->update($panier);
		}
	}
	//finalisation
	if (isset($_GET['page'], $_GET['action'], $_SESSION['panier']) && $_GET['page'] == 'panier' && $_POST['action'] == 'validate')
	{
		//login?
		if (!isset($_SESSION['id']))
		{
			header('Location: index.php?page=login&action=validate');
			exit;
		}
		header('Location: index.php?page=paiement');
		exit;
	}
	//validation
	if ($_SESSION['admin'] && isset($_GET['page'], $_POST['id_panier']) && $_GET['page'] == 'admin')
	{
		$panier = $panier_manager->getById($_POST['id_panier']);
		$panier->setStatut('validé');
		$panier = $panier_manager->update($panier);
	}
}
catch(Exception $e)
{
	$error = $e->getMessage;
}
?>