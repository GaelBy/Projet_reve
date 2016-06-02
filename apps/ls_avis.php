<?php

$i = 0;
while ($i < sizeof($list))
{
	$avis = $list[$i];
	require('views/ls_avis.phtml');
	$i++;
}
?>