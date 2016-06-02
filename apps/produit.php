<?php
<<<<<<< HEAD
<<<<<<< HEAD

require('views/produit.phtml');
=======
=======
$manager = new ProduitsManager($link);
$produit = $manager->getById($_GET['id_produit']);
>>>>>>> cfab82f01cc0d9ee9159b175c3b802776d1f45f4
if ($produit->getStatut())
{
	$id = $produit->getId();
	$reference = $produit->getReference();
	$stock = $produit->getStock();
	$prix_uni_ht = $produit->getPrixUniHt();
	$prix_uni_ttc = $produit->setPrixUniTtc();
	$description = $produit->getDescription();
	$image = $produit->getImage();
	$nom = $produit->getNom();
	$moyenne = $produit->setMoyenne();
	$ajout_ok = 'hide';
	$modif_ok = 'hide';
	$list = $produit->getAvis();
	$avis_class = '';
	$no_avis = 'hide';
	if (empty($list))
	{
		$avis_class = 'hide';
		$no_avis = '';
	}
	if (isset($_SESSION['id']))
	{
		$i = 0;
		while ($i < sizeof($list))
		{
			$avis = $list[$i];
			if ($avis->getIdAuthor() == $_SESSION['id'])
				$modif_ok = '';
			$i++;
		}

		$panier_manager = new PanierManager($link);
		$panier_list = $panier_manager->getByIdUser($_SESSION['id']);
		$i = 0;
		while ($i < sizeof($panier_list))
		{
			$panier = $panier_list[$i];
			$produit_list = $panier->getProduits();
			if (in_array($produit, $produit_list) && $panier->getStatut() == "validé" && $modif_ok == 'hide')
				$ajout_ok = '';
			$i++;
		}
	}
	require('views/produit.phtml');
}
>>>>>>> 484ebcd6df7aacb5a9be68ad907f833dbba26937
?>