<?php
$produit_id = $produit->getId();
$nom = $produit->getNom();
$reference = $produit->getReference();
$image = $produit->getImage();
$quantite = $produit->getQuantite();
$prix_u = $produit->getPrixUniTtc();
$prix_produit = $prix_u * $quantite;
$poids_u = $produit->getPoidsUni();
$poids_produit = $poids_u * $quantite;
require('views/produit_panier.phtml');
?>