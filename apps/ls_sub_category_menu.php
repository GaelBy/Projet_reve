<?php
$count2=0;
$lsSubCategory = $categorie->getSubCategory();
while($count2<sizeof($lsSubCategory))
{
	$subcategory = $lsSubCategory[$count2];
	if ($subcategory->getStatut())
		require('views/ls_sub_category_menu.phtml');
	$count2++;
}
?>