<?php
$category_manager = new categoryManager($link);
$list_cat = $category_manager->getAll();
$i = 0;
while ($i < sizeof($list_cat))
{
	$category = $list_cat[$i];
	require('views/ls_category_admin.phtml');
	$i++;
}
?>