<?php
session_start();
$error='';
$page='home';



$acces = array('login','logout','register','home');

if(isset($_GET['page']))
{
 if(in_array($_GET['page'],$acces))
 {

 	$page = $_GET['page'];
 }
}




$acces_traitement = array();














require('apps/skel.php')







?>