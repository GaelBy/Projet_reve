<?php
$count=0;
$manager=new ProduitsManager($link);
$lsProduitsNotes = $manager->getByMoyenne(4);
while($count<sizeof($lsProduitsNotes))
{
	$produitNote=$lsProduitsNotes[$count];
	require('views/ls_produits_notes.phtml');
	$count++;
}
?>