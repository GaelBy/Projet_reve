<?php
$count=0;
$manager = new CategoryManager ($link);
$lsCategory = $manager->getAll();

while($count<sizeof($lsCategory))
{
	require('views/ls_category_menu.phtml');
	$count++;
}

?>