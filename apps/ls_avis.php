<?php

$i = 0;
while ($i < sizeof($list))
{
	$avis = $list[$i];
	if ($avis->getStatut())
		require('views/ls_avis.phtml');
	$i++;
}
?>