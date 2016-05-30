<?php
session_start();
$error='';
$page='home';

function __autoload($class_name) {
    include $class_name . '.php';
}




$acces = array('login','logout','register','home');

if(isset($_GET['page']))
{
 if(in_array($_GET['page'],$acces))
 {

 	$page = $_GET['page'];
 }
}




$acces_traitement = array('login','register','logout');

if (in_array($page, $acces_traitement))
	require('apps/traitement_'.$page.'.php');














require('apps/skel.php')







?>