<?php
if(isset($_GET['id']))
{
	$manager = new SubCategoryManager($link);
	$subcategory = $manager->getById($_GET['id']);
	require('views/sub_category.phtml');
}
// require('apps/produit_item.php');


?>