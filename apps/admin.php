<?php
if (isset($_SESSION['admin']) && $_SESSION['admin'])
	require('views/admin.phtml');

?>