<?php

$res_sub = new SubCategoryManager($link);

$_id_sub = 1;/*$_GET['id_category'];*/

 


$array_sub = $res_sub->getByIdCategory($_id_sub);


$iSub = 0;
$nbSub = count( $array_sub );
while($iSub < $nbSub){
	$affiche_sub = $array_sub[$iSub];
	require('views/sub_category.phtml');
	$iSub++;
}


	




?>