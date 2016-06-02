<?php
session_start();
$error='';
$page='home';

function __autoload($class_name) {
    require('models/'.$class_name.'.class.php');
}
require('apps/config.php');
$link = mysqli_connect($localhost, $login, $pass, $database);
if (!$link)
{
	require('views/bigerror.phtml');
	exit;
}

<<<<<<< HEAD


$acces = array('login','logout','register','home', 'category', 'sub_category', 'produit', 'panier', 'paiement', 'conf_paiement', 'avis', 'profil_user', 'admin', 'admin_category', 'admin_produits', 'admin_avis', 'category');



=======
$acces = array('login','logout','register','home', 'category', 'sub_category', 'produit', 'panier', 'paiement', 'conf_paiement', 'avis', 'profil_user', 'admin', 'admin_category', 'admin_produits', 'admin_avis', 'category');

>>>>>>> 77480c144f14e58d9c2979e7aa698d7733b4c22f
if(isset($_GET['page']))
{
 if(in_array($_GET['page'],$acces))
 {

 	$page = $_GET['page'];
 }
}

$acces_traitement = array('login'=>'users','register'=>'users','logout'=>'users', 
	                      'produit'=>'panier', 'panier'=>'panier', 'paiement'=>'paiement', 'avis'=>'avis',
	                      'profil_user'=>'users', 'admin_category'=>'category', 

	                      'admin_produits'=>'produits');

if (array_key_exists($page, $acces_traitement))
	require('apps/traitement_'.$acces_traitement[$page].'.php');

// $('#panier').load('index.php?page=panier&ajax');
// require('apps/produit.php');
// exit;
if (isset($_GET['ajax']))
{
	$accessAjax = [];
	require('apps/'.$pageAjax.'.php');
}
else
	require('apps/skel.php');
?>