<?php
//register
$manager = new UserManager($link);
if (!empty($_POST) && isset($_GET['page']) && $_GET['page'] == 'register')
{
	try
	{
		$user = $manager->create($_POST);
		if (isset($_SESSION['panier'], $_GET['action']) && $_GET['action'] = 'validate')
			header('Location: index.php?page=login&action=validate');
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
if (!empty($_POST) && isset($_GET['page']) && $_GET['page'] == 'login')
{
	try
	{
		$user = $manager->getByLogin($_POST['login']);
		if ($user)
		{
			if ($user->verifLogin($_POST['password']))
			{
				$_SESSION['id'] = $user->getId();
				if (isset($_SESSION['panier'], $_GET['action']) && $_GET['action'] == 'validate')
				{
					if ($user->getAdmin() == 1)
						$_SESSION['admin'] = 1;
					$panier_manager = new PanierManager($link);
					$panier = $panier_manager->getById($_SESSION['panier']);
					$panier->setIdUser(intval($_SESSION['id']));
					$panier = $panier_manager->update($panier);
					header('Location: index.php?page=panier');
					exit;
				}
				else if ($user->getAdmin() == 1)
				{
					$_SESSION['admin'] = 1;
					header('Location: index.php?page=admin');
					exit;
				}
				else
				{
					header('Location: index.php?page=home');
					exit;
				}
			}
		}
		else
			$error = 'Login inconnu';
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
if (isset($_POST, $_GET['page'], $_GET['action']) && $_GET['page'] == 'profil_user')
{
	if ($_GET['action'] == 'edit')
	{
		if (isset($_SESSION['id']))
		{
			try
			{
				$user = $manager->findById($_SESSION['id']);
				if (isset($_POST['nom']))
					$user->setNom($_POST['nom']);
				else
					throw new Exception('Paramètre manquant : nom');
				if (isset($_POST['prenom']))
					$user->setPrenom($_POST['prenom']);
				else
					throw new Exception('Paramètre manquant : prénom');
				if (isset($_POST['email']))
					$user->setEmail($_POST['email']);
				else
					throw new Exception('Paramètre manquant : email');
				if (isset($_POST['password']))
					$user->setPassword($_POST['password']);
				else
					throw new Exception('Paramètre manquant : mot de passe');
				if (isset($_POST['telephone']))
					$user->setTelephone($_POST['telephone']);
				else
					throw new Exception('Paramètre manquant : prénom');
				$user = $manager->update($user);
				$adresse_manager = new AdresseManager($link);
				$list_adresse = $user->getAdresse();
				$i = 0;
				while ($i < sizeof($list_adresse))
				{
					$adresse = $list_adresse[$i];
					$i++;
					if (isset($_POST['nom_adresse'.$i]))
						$adresse->setNom($_POST['nom_adresse'.$i]);
					else
						throw new Exception('Paramètre manquant: nom adresse');
					if (isset($_POST['numero'.$i]))
						$adresse->setNumero($_POST['numero'.$i]);
					else
						throw new Exception('Paramètre manquant: numéro');
					if (isset($_POST['rue'.$i]))
						$adresse->setRue($_POST['rue'.$i]);
					else
						throw new Exception('Paramètre manquant: rue');
					if (isset($_POST['ville'.$i]))
						$adresse->setVille($_POST['ville'.$i]);
					else
						throw new Exception('Paramètre manquant: ville');
					if (isset($_POST['code_postal'.$i]))
						$adresse->setCodePostal($_POST['code_postal'.$i]);
					else
						throw new Exception('Paramètre manquant: code postal');
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
		if (isset($_SESSION['admin']) && $_SESSION['admin'])
		{
			try
			{
				$user = $manager->getById($_POST['id_user']);
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