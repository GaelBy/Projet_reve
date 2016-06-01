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


$acces = array('login','logout','register','home', 'category', 'sub_category', 'produit', 'panier', 'paiement', 'conf_paiement', 'avis', 'profil_user', 'admin', 'admin_category', 'admin_produits', 'admin_avis','sidebar');
>>>>>>> 484ebcd6df7aacb5a9be68ad907f833dbba26937

if(isset($_GET['page']))
{
 if(in_array($_GET['page'],$acces))
 {

 	$page = $_GET['page'];
 }
}




$acces_traitement = array('login'=>'users','register'=>'users','logout'=>'users', 
	                      'produit'=>'panier', 'paiement'=>'paiement', 'avis'=>'avis',
	                      'profil_user'=>'users', 'admin_category'=>'category', 

	                      'admin_produits'=>'produits');

if (array_key_exists($page, $acces_traitement))
	require('apps/traitement_'.$acces_traitement[$page].'.php');














require('apps/skel.php')







?>