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



$acces = array('login','logout','register','home', 'category', 'sub_category', 'produit', 'panier', 'paiement', 'conf_paiement', 'avis', 'profil_user', 'admin', 'admin_category', 'admin_produits', 'admin_avis','diffusionAvis','search_result');



if(isset($_GET['page']))
{
 if(in_array($_GET['page'],$acces))
 {

 	$page = $_GET['page'];
 }
}

$acces_traitement = array('login'=>'users','register'=>'users','logout'=>'users', 
	                      'produit'=>'panier', 'panier'=>'panier', 'paiement'=>'paiement', 'avis'=>'avis',
	                      'profil_user'=>'users', 'admin'=>'panier', 'admin_category'=>'category', 
	                      'admin_avis'=>'avis',
	                      'admin_produits'=>'produits','search_result'=>'produits'); //NB: ici, on indique aussi de quel fichier traitement dépend la page. Par exemple, ici, search_result pointe vers le traitement produits.

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