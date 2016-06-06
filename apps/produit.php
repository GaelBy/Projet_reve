<?php
$manager = new ProduitsManager($link);
$produit = $manager->getById($_GET['id_produit']);
$admin = 'hide';
if (isset($_SESSION['admin']) && $_SESSION['admin'])
	$admin = '';
if ($produit->getStatut())
{
	// $id = $produit->getId();
	// $reference = $produit->getReference();
	// $stock = $produit->getStock();
	// $prix_uni_ht = $produit->getPrixUniHt();
	// $prix_uni_ttc = $produit->setPrixUniTtc();
	// $description = $produit->getDescription();
	// $image = $produit->getImage();
	// $nom = $produit->getNom();
	// $moyenne = $produit->setMoyenne();
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
			if ($avis->getAuthor()->getId() == $_SESSION['id'])
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
			$j = 0;
			while ($j < sizeof($produit_list))
			{
				if ($produit->getId() == $produit_list[$j]->getId() && $panier->getStatut() == "valide" && $modif_ok == 'hide')
					$ajout_ok = '';
				$j++;				
			}
			$i++;
		}
	}
	require('views/produit.phtml');
}
?>