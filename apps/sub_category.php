<?php

if(isset($_GET['id']))
{


	$res_sub = new ProduitsManager($link);

	$_id_sub = echo $_GET['id'];/*$_GET['id_category'];*/

	 


	$array_sub = $res_sub->getBySubCategory($_id_sub);


	$iSub = 0 ;
	$nbSub = count( $array_sub );
	while($iSub < $nbSub)
	{
		$affiche_sub = $array_sub[$iSub];
		require('views/sub_category.phtml');
		$iSub++;
	}


}	




?>