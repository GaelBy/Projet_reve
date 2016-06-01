<?php
if ($produit->getStatut())
{
	$manager = new ProduitsManager($link);
	$produit = $manager->getById($_GET['id_produit']);
	$id = $produit->getId();
	$reference = $produit->getReference();
	$stock = $produit->getStock();
	$prix_uni_ht = $produit->getPrixUniHt();
	$prix_uni_ttc = $produit->getPrixUniTtc();
	$description = $produit->getDescription();
	$image = $produit->getImage();
	$nom = $produit->getNom();
	require('views/produit.phtml');
}
?>