<?php
$count=0;
$manager=new AvisManager($link);
$lsAvis=$manager->getAll();

while($count<sizeof($lsAvis))
{
$avis=$lsAvis[$count];
$valider = '';
$moderer = 'hide';
if ($avis->getStatut())
{
	$valider = 'hide';
	$moderer = '';
}
require('views/ls_admin_avis.phtml');
$count++;
}

?>