<?php
if (isset($_GET['search']))
{
	$no_result = 'hide';
	$results = '';
	if (empty($_GET['search']))
	{
		$no_result = '';
		$results = 'hide';
	}
	$manager=new ProduitsManager($link);
	$lsResult=$manager->getSearch($_GET['search']);
	require('views/search_result.phtml');
}
?>