<?php
if (isset($_SESSION['id'], $_SESSION['panier']))
{
	$manager = new PanierManager($link);
	$panier = $manager->getById($_SESSION['panier']);
	//$prix = $panier->getPrix();
	$user_manager = new UserManager($link);
	$user = $user_manager->getById($_SESSION['id']);
	$adresse_facturation = $user->getAdresseFacturation();
	if (empty($adresse_facturation))
	{
		$adresse_facturation = new Adresse($link);
		$adresse_facturation->setIdUser($user->getId());
		$adresse_facturation->setTypeAdresse('facturation');
	}
	$adresse_livraison = $user->getAdresseLivraison();
	if (empty($adresse_livraison))
	{
		$adresse_livraison = new Adresse($link);
		$adresse_livraison->setIdUser($user->getId());
		$adresse_livraison->setTypeAdresse('livraison');
	}
	require('views/paiement.phtml');
}


?>