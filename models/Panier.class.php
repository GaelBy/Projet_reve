<?php

class Panier {

   private $id;
   private $id_user;
   private $date;
   private $statut;
   private $nbre_produits;
   private $poids;
   private $link;
   private $produits;

   public function __construct($link)
   {
    $this->link = $link;
   }

   public function getId(){

   	return $this ->id ;
   }

   public function getIdUser(){

   	return $this ->id_user;
   }

   public function getDate(){

   	return $this ->date ;
   }

   public function getStatut(){

   	return $this ->statut ;
   }

   public function getPrix(){

   	return $this ->prix ;
   }

   public function getNbreProduits(){

   	return $this ->nbre_produits ;
   }

   public function getPoids(){

   	return $this ->poids ;
   }

   public function getProduits()
   {
    $manager = new ProduitsManager($this->link);
    $this->produits = $manager->getByPanier($this);
    return $this->produits;
   }


   public function ajoutProduit(Produit $produit)
   {
    $this->produits[] = $produit;
    $this->nbre_produits =sizeof($produits);
   }

public function setIdUser($id_user){

    if(! is_int($id_user))
    {
    	throw new Exception 'ce n\'est pas un chiffre' ;
    }
    
    

    	$this->id_user = $id_user;
    

}



public function setStatut($statut)
	{
		if (is_int($statut)||strlen($statut) < 5)
		{
			throw new Exception  "veuillez entrer au moin 5 carracteres (lettres)";
		}

		$this->statut=$statut;
	}






public function setPrix($prix){

	if(! is_int($prix))
	{
		throw new Exception  'veuillez entrer un chiffre ';
	}

	$this ->prix = $prix ;


	
}


public function setNbreProduits($nbre_produits){

	if(! is_int($nbre_produits))
	{
		throw new Exception  "veuillez entrer un chiffre";
	}

	$this ->nbre_produits = $nbre_produits;


	
}

public function setPoids($poids){

	if(! is_int($poids))
	{
		throw new Exception  "veuillez entrer un chiffre";
	}

	$this ->poids = $poids;







	
}









}

/*
$panierManager = new PanierManager($link);
$panier = $panierManager->getCurrent();
$produits = $panier->getProduits();
$count = 0;
$max = sizeof($produits);
while ($count < $max)
{
  $produit = $produits[$count];
  require('views/displayProduit.phtml');
  $count++;
}
*/
?>






