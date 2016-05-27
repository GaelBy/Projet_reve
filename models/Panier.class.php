<?php

class Panier {

   private $id;
   private $id_user;
   private $date;
   private $statut;
   private $nombre_produits;
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

   public function getNombreProduits(){

   	return $this ->nombre_produits ;
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
    $this->nombre_produits =sizeof($produits);
   }

public function setIdUser($id_user){

    if(! is_int($id_user))
    {
    	trow new Exeption 'ce n\'est pas un chiffre' ;
    }
    
    

    	$this->id_user = $id_user;
    

}

public function setDate($date){

	if ( ! preg_match ( " \^([0-3][0-9]})(/)([0-9]{2,2})(/)([0-3]{2,2})$\ " , $date ) ))

    {
    	trow new Exeption 'veuillez entrer une date au bon format';
    }
    
    
    	$this->date = $date ;
    


	
}


public function setStatut($statut)
	{
		if (is_bool($statut)==FALSE)
		{
			trow new Exeption  "Ce n'est pas un booléen";
		}

		$this->statut=$statut;
	}






public function setPrix($prix){

	if(! is_int($prix))
	{
		trow new Exeption 'veuillez entrer un chiffre ';
	}

	$this ->prix = $prix ;


	
}


public function setIdUser($nombre_produits){

	if(! is_int($nombre_produits))
	{
		trow new Exeption "veuillez entrer un chiffre";
	}

	$this ->nombre_produits = $nombre_produits;


	
}

public function setPoids($poids){

	if(! is_int($poids))
	{
		trow new Exeption "veuillez entrer un chiffre";
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






