<?php

$count=0;

while($count<sizeof($lsResult))
{
	$result=$lsResult[$count];
	require('views/ls_result.phtml');
	$count++;
}

?>