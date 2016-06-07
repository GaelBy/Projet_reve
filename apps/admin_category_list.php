<?php
$category_manager = new categoryManager($link);
$list_cat = $category_manager->getAll();
$i = 0;
while ($i < sizeof($list_cat))
{
	$category = $list_cat[$i];
	$select = '';
	if ($id_cat == $category->getId())
		$select = 'selected';
	require('views/admin_category_list.phtml');
	$i++;
}
?>