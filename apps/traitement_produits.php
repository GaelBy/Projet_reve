<?php
$manager=new Produitsmanager($link);

//CREATION
if ($_GET['action']=='create' && $_SESSION['admin']==TRUE)
{
	try
	{
		$produit=$manager->create($_POST);
		header('Location: index.php?page=produit&id='.$produit->getId);
		exit;
	}
	catch(Exception $e)
	{
		$error=$e->getMessage();
	}
}
?>