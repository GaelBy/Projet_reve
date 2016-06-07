



<?php
if(isset($_GET['id_sub_category']))
{
	$manager = new SubCategoryManager($link);
	$subcategory = $manager->getById($_GET['id_sub_category']);
    
	
	require('views/sub_category.phtml');
    
}
    //require('apps/produit_item.php');


?>