<?php
if (isset($_SESSION['id'], $_SESSION['panier']))
{
	$manager = new PanierManager($link);
	$panier = $manager->getById($_SESSION['panier']);
	$prix = $panier->getPrix();
	$user_manager = new UserManager($link);
	$user = $user_manager->getById($_SESSION['id']);
	$list = $user->getAdresse();
	require('views/paiement.phtml');
}
?>