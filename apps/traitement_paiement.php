<?php
//si numéro cb ok
if (isset($_POST['numero_carte']))
{
	try
	{
	//mettre le panier en attente de validation
		$manager = new PanierManager($link);
		$panier = $manager->getById($_POST['id_panier']);
		$panier->setStatut('Payé');
		$panier = $manager->update($panier);
	//baisser le stock
		$manager = new ProduitManager($link);
		$list = $panier->getProduits();
		$i = 0;
		while ($i < sizeof($list))
		{
			$produit = $list[$i];
			$produit->setStock($produit->getStock - $produit->getQuantite);
			$produit = $manager->update($produit);
			$i++;
		}
		header('Location: index.php?page=conf_paiement&id_panier='.$panier->getId);
		exit;
	}
	catch(Exception $e)
	{
		$error = $e->getMessage;
	}
}
?>