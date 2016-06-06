<?php
$produit_manager = new ProduitsManager($link);
$produit = $produit_manager->getById($_GET['id_produit']);
if (isset($_SESSION['id']))
{
	if (isset($_GET['action']) && $_GET['action'] == 'creer')
	{
		/*$i = 0;
		while ($i < sizeof($list))
		{
			$avis = $list[$i];
			if ($avis->getAuthor()->getId() == $_SESSION['id'])
				$modif_ok = '';
			$i++;
		}*/

		$panier_manager = new PanierManager($link);
		$panier_list = $panier_manager->getByIdUser($_SESSION['id']);
		$i = 0;
		while ($i < sizeof($panier_list))
		{
			$panier = $panier_list[$i];
			$produit_list = $panier->getProduits();
			$j = 0;
			while ($j < sizeof($produit_list))
			{
				if ($produit->getId() == $produit_list[$j]->getId() && $panier->getStatut() == "valide")
					$avis = new Avis($link);
				$j++;
			}
			$i++;
		}
		if (!isset($avis))
			$error = 'produit non acheté';

		/*$manager = new UserManager($link);
		$user = $manager->getById($_SESSION['id']);
		$list = $user->getPanier();
		$i = 0;
		while ($i < sizeof($list))
		{
			$panier = $list[$i];
			if ($panier->getStatut() == 'valide')
			{
				$produits = $panier->getProduits();
				$j = 0;
				while ($j < sizeof($produits))
				{
					if ($produits[$j]->getId() == $_GET['id_produit'])
					$j++;
				}
			}
			$i++;
		}*/
	}
	if (isset($_GET['action']) && $_GET['action'] == 'modifier')
	{
		$avis_list = $produit->getAvis();
		$i = 0;
		while ($i < sizeof($avis_list))
		{
			if ($avis_list[$i]->getAuthor()->getId() == $_SESSION['id'])
				$avis = $avis_list[$i];
			$i++;
		}
		$error = "Pas d'avis pour ce produit et cet user";
	}
}
else
	$error = 'non connecté';
if (empty($error))
	require('views/avis.phtml');
?>