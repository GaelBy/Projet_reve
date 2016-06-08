<?php
$count=0;
$manager=new AvisManager($link);
$lsAvis = $manager->getAll();
while($count<sizeof($lsAvis))
{
	$avisDiffuse=$lsAvis[$count];
	if ($avisDiffuse->getStatut())
		require('views/diffusionAvis.phtml');
	$count++;
}
?>