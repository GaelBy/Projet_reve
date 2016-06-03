<?php
$count=0;
$manager = new SubCategoryManager ($link);
$lsSubCategory = $manager->getByCategory($category);

while($count<sizeof($lsSubCategory))
{
	$subCategorie = $lsSubCategory[$count];
	require('views/ls_sub_category.phtml');
	$count++;
}
?>