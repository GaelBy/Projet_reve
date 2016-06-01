<?php
<<<<<<< HEAD

require('views/produit.phtml');
=======
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
>>>>>>> 484ebcd6df7aacb5a9be68ad907f833dbba26937
?>