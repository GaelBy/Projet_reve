<?php
if (isset($_POST['action']) && $_POST['action'] == 'adresse')
{
	try
	{
		$user_manager = new UserManager($link);
		$user = $user_manager->getById($_SESSION['id']);
		$adresse_manager = new AdresseManager($link);
		$list_adresse = $user->getAdresse();
		if (empty($list_adresse))
		{
			$data1 = ['id_user'=>$user->getId(), 'nom_adresse' => $_POST['nom_adresse1'], 'numero' => $_POST['numero1'], 'rue' => $_POST['rue1'], 'ville' => $_POST['ville1'], 'code_postal' => $_POST['code_postal1'], 'type_adresse' => 'facturation'];
			$data2 = ['id_user'=>$user->getId(), 'nom_adresse' => $_POST['nom_adresse2'], 'numero' => $_POST['numero2'], 'rue' => $_POST['rue2'], 'ville' => $_POST['ville2'], 'code_postal' => $_POST['code_postal2'], 'type_adresse' => 'livraison'];
			$adresse1 = $adresse_manager->create($data1);
			$adresse2 = $adresse_manager->create($data2);
		}
		else
		{
			$i = 0;
			while ($i < sizeof($list_adresse))
			{
				$adresse = $list_adresse[$i];
				$i++;
				$adresse->setNom($_POST['nom_adresse'.$i]);
				$adresse->setNumero($_POST['numero'.$i]);
				$adresse->setRue($_POST['rue'.$i]);
				$adresse->setVille($_POST['ville'.$i]);
				$adresse->setCodePostal($_POST['code_postal'.$i]);
				$adresse = $adresse_manager->update($adresse);
			}
		}
	}
	catch (Exception $e)
	{
		$error = $e->getMessage();
	}
}
//si numéro cb ok
if (isset($_POST['numero_carte']))
{
	try
	{
	//mettre le panier en attente de validation
		$manager = new PanierManager($link);
		$panier = $manager->getById($_POST['id_panier']);
		$panier->setStatut('Paye');
		$panier = $manager->update($panier);
	//baisser le stock
		$manager = new ProduitsManager($link);
		$list = $panier->getProduits();
		$i = 0;
		while ($i < sizeof($list))
		{
			$produit = $list[$i];
			$produit->setStock($produit->getStock() - $produit->getQuantite());
			$produit = $manager->update($produit);
			$i++;
		}
		header('Location: index.php?page=conf_paiement&id_panier='.$panier->getId());
		exit;
	}
	catch(Exception $e)
	{
		$error = $e->getMessage();
	}
}
?>