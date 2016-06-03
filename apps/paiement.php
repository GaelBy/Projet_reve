<?php
if (isset($_SESSION['id'], $_SESSION['panier']))
{
	$manager = new PanierManager($link);
	$panier = $manager->getById($_SESSION['panier']);
	//$prix = $panier->getPrix();
	$user_manager = new UserManager($link);
	$user = $user_manager->getById($_SESSION['id']);
	$adresse_facturation = $user->getAdresseFacturation();
	$adresse_livraison = $user->getAdresseLivraison();
	require('views/paiement.phtml');
}
?>