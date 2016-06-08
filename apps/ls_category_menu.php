<?php
$count=0;
$manager = new CategoryManager ($link);
$lsCategory = $manager->getAll();

while($count<sizeof($lsCategory))
{
	$categorie = $lsCategory[$count];
	if ($categorie->getStatut()) 
		require('views/ls_category_menu.phtml');
	$count++;
}

?>