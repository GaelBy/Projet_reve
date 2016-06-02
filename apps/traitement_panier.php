<?php
$produit_manager = new ProduitsManager($link);
$panier_manager = new PanierManager($link);
try
{
	if (isset($_POST['id_produit']))
	{
		$produit = $produit_manager->getById($_POST['id_produit']);
		$produit->setPrixUniTtc();
		//add
		if (isset($_GET['page']) && $_GET['page'] == 'produit')
		{
			//create?
			if (!isset($_SESSION['panier']))
			{
				//$panier = new Panier($link);
				$data = array('id_user'=>10, 'statut'=>'en cours', 'prix'=>0, 'nombre_produits'=>0, 'poids'=>0);
				if (isset($_SESSION['id']))
					$data['id_user'] = $_SESSION['id'];
				$panier = $panier_manager->create($data);
				$_SESSION['panier'] = $panier->getId();
				$produit_manager->initPanierProduit($produit);
			}
			$panier = $panier_manager->getById($_SESSION['panier']);
			$panier->ajoutProduit($produit);
			$panier = $panier_manager->update($panier);
			}
		else if (isset($_GET['page'], $_POST['action']) && $_GET['page'] == 'panier' && $_POST['action'][0] == 'remove')
		{
			//remove
			$panier = $panier_manager->getById($_SESSION['panier']);
			$panier->suppressionProduit($produit);
			$panier = $panier_manager->update($panier);
		}
	}
	//finalisation
	if (isset($_GET['page'], $_POST['action'], $_SESSION['panier']) && $_GET['page'] == 'panier' && $_POST['action'] == 'validate')
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
	if (isset($_GET['page'], $_POST['id_panier'], $_SESSION['admin']) && $_SESSION['admin'] && $_GET['page'] == 'admin')
	{
		$panier = $panier_manager->getById($_POST['id_panier']);
		$panier->setStatut('validé');
		$panier = $panier_manager->update($panier);
	}
}
catch(Exception $e)
{
	$error = $e->getMessage();
}
?>