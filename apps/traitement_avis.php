<?php
if (!isset($_SESSION['login']))
{
	header('Location: ?page=login');
	exit;
}

if (isset($_POST['produit_note'], $_POST['avis_item'], $_POST['produit_panier']))
{
	$success = true;
	$produit_note = $_POST['produit_note'];
	$avis_item = $_POST['avis_item'];
	$produit_panier = $_POST['produit_panier'];

	if(strlen($produit_panier) == 0)
		$success = false;
		
	if ($success){
		$date_avis = date('Y-m-d H:m:i');
		$query = "INSERT INTO avis (produit_note, avis_item, `date`, produit_panier) VALUES ('".$produit_note."', '".$avis_item ."', '".$date_avis."', '".$produit_panier."')";
		$res = mysqli_query( $link, $query);
		header('Location: ?page=panier_item&id='.$avis_item);
		exit;
	}
	else
		$error = 'Merci de vous connecter avant de déposer un avis.';
}

if (isset($_POST['produit_panier']))
{
	$success = true;
	$produit_panier = $_POST['produit_panier'];
	//$id_commentaires = $_POST['id_commentaires'];



?>