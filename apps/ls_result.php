<?php
$count=0;
$manager=new Manager($link);
$lsResult=$manager->getSearch($search);
while($count<sizeof($lsResult))
{
	$result=$lsResult[$count];
	require('views/ls_result.phtml');
	$count++;
}
?>