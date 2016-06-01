<?php
$count2=0;
$lsSubCategory = $categorie->getSubCategories();
//$manager = new SubCategoryManager ($link);
// $lsSubCategory = $manager->getByIdCategory($id_category);

while($count2<sizeof($lsSubCategory))
{
	$subcategory = $lsSubCategory[$count2];
	require('views/ls_sub_category_menu.phtml');
	$count2++;
}
?>