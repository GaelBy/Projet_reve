<?php
$count=0;
$manager = new SubCategoryManager ($link);
$lsSubCategory = $manager->getByIdCategory($id_category);

while($count<sizeof($lsSubCategory))
{
	require('views/ls_sub_category_menu.phtml');
	$count++;
}
?>