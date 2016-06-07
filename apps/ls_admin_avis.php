<?php
$count=0;
$manager=new avisManager($link);
$lsAvis=$manager->getAll();

while($count<sizeof($lsAvis))
{
$avis=$lsAvis[$count];
require('views/ls_admin_avis.phtml');
$count++;
}

?>