<?php
$manager=new Produitsmanager($link);
if () // voir pour quelle vérification faire?
{
	try
	{
		$produit=$manager->create($_POST);
		$infos=['id'=>$produit->getId(), 'id_sub_category'=>$produit->getIdSubCategroy(),'reference'=>$_POST['reference'], 'stock'=>$_POST['stock'],
		'prix_uni_ht'=$_POST['prix_uni_ht'], 'tva'=>$_POST['tva'], 'description'=>$_POST['description'], 'image'=>$_POST['image'], 'nom'=>$_POST['nom'],
		'poids_uni'=>$_POST['poids_uni'], 'statut'=>$_POST['statut']],

		if(isset($_GET['id'],$_GET['action']) && $_GET['action'] ='validate')
		{
			header('Location: index.php?page=produit&id='.$_GET['id'].'&action=validate');
		}
		else
		{
			header('Location:index.php?page=admin_produits');
		}
		exit;
	}
	catch(Exception $e)
	{
		$error=$e->getMessage();
	}
}
?>