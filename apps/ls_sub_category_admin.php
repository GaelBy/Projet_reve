<?php
$list_subcat = $category->getSubCategory();
$j = 0;
while ($j < sizeof($list_subcat))
{
	$select = '';
	$subcategory = $list_subcat[$j];
	if ($subcategory->getId() == $produit->getSubCategory()->getId())
		$select = 'selected';
	require('views/ls_sub_category_admin.phtml');
	$j++;
}
?>