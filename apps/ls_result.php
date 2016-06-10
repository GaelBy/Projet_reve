<?php
if (isset($_GET['search']))
{
	$count=0;
	$manager=new ProduitsManager($link);
	$lsResult=$manager->getSearch($_GET['search']);
	while($count<sizeof($lsResult))
	{
		$result=$lsResult[$count];
		require('views/ls_result.phtml');
		$count++;
	}
}
?>