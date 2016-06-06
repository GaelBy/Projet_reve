<?php
$count=0;
$manager=new PanierManager($link);
$lsPaniers=$manager->getByStatut('payé');

while($count<sizeof($lsPaniers))
{
$panier=$lsPaniers[$count];
require('views/ls_admin_panier.phtml');
$count++;
}

?>