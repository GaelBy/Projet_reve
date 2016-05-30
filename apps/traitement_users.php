<?php
//register
$manager = new UserManager($link);
if (isset($_GET['page']) && $_GET['page'] == 'register')
{
	try
	{
		$user = $manager->create($_POST);
		$data1 = ['id_user'=>$user->getId(), 'nom_adresse' => $_POST['nom_adresse1'], 'numero' => $_POST['numero1'], 'rue' => $_POST['rue1'], 'ville' => $_POST['ville1'], 'code_postal' => $_POST['code_postal1'], 'type_adresse' => 'facturation'];
		$data2 = ['id_user'=>$user->getId(), 'nom_adresse' => $_POST['nom_adresse2'], 'numero' => $_POST['numero2'], 'rue' => $_POST['rue2'], 'ville' => $_POST['ville2'], 'code_postal' => $_POST['code_postal2'], 'type_adresse' => 'livraison'];
		$adresse_manager = new AdresseManager($link);
		$adresse = $adresse_manager->create($data1);
		$adresse = $adresse_manager->create($data2);
		if (isset($_GET['panier_id'], $_GET['action']) && $_GET['action'] = 'validate')
			header('Location: index.php?page=login&panier_id='.$_GET['panier_id'].'&action=validate');
		else
			header('Location: index.php?page=login') ;
		exit;
	}
	catch (Exception $e)
	{
		$error = $e->getMessage();
	}
}
//login
if (isset($_GET['page']) && $_GET['page'] == 'login')
{
	try
	{
		$user = $manager->login($_POST);
		$_SESSION['id'] = $user->getId();
		//ajouter cas si login avec panier en cours
		if (isset($_GET['id_panier'], $_GET['action']) && $_GET['action'] = 'validate')
		{
			$panier_manager = new PanierManager($link);
			$panier = $panier_manager->getById($_GET['id_panier']);
			$panier->setIdUser($_SESSION['id']);
			header('Location: index.php?page=paiement&id_panier='.$panier->getId());
			exit;
		}
		if ($user->admin == 1)
		{
			$_SESSION['admin'] = 1;
			header('Location: index.php?page=admin');
			exit;
		}
		header('Location: index.php?page=home');
		exit;
	}
	catch (Exception $e)
	{
		$error = $e->getMessage();
	}
}
//logout
if (isset($_GET['page']) && $_GET['page'] == 'logout')
{
	session_destroy();
	header('Location: index.php?page=home');
	exit;
}
//edit
if (isset($_GET['page'], $_GET['action']) && $_GET['page'] == 'profil_user')
{
	if ($_GET['action'] == 'edit')
	{
		if ($_SESSION['id'] == $_GET['id_user'] || $_SESSION['admin'])
		{
			try
			{
				$user = $manager->findById($_GET['id_user']);
				$user->setNom($_POST['nom']);
				$user->setPrenom($_POST['prenom']);
				$user->setEmail($_POST['email']);
				$user->setPassword($_POST['password']);
				$user->setTelephone($POST['telephone']);
				$user = $manager->update($user);
				$adresse_manager = new AdresseManager($link);
				$list_adresse = $user->getAdresse();
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
			catch (Exception $e)
			{
				$error = $e->getMessage();
			}
		}
	}
//delete
	else if ($_GET['action'] == 'delete')
	{
		if ($_SESSION['admin'])
		{
			try
			{
				$user = $manager->getById($_GET['id_user']);
				$user = $manager->delete($user);
				header('Location: index.php?page=admin');
				exit;
			}
			catch (Exception $e)
			{
				$error = $e->getMessage();
			}
		}
	}
}
?>