<?php

class Panier {

   private $id;
   private $id_user;
   private $date;
   private $statut;
   private $nbre_produits;
   private $prix;
   private $poids;

   private $produits;// NULL ==> correspond à la liste des produits dans le panier
   
   private $link; //link utilisé pour la composition

   public function __construct($link)
   {
    $this->link = $link;
   }

   public function getId(){

   	return $this->id ;
   }

   public function getIdUser(){

   	return $this->id_user;
   }

   public function getDate(){

   	return $this->date ;
   }

   public function getStatut(){

   	return $this->statut ;
   }

   public function getPrix(){

   	return $this->prix ;
   }

   public function getNombreProduits(){

   	return $this->nbre_produits ;
   }

   public function getPoids(){

   	return $this->poids ;
   }

   public function getProduits() //sert à récupérer la liste des produits qui sont dans le panier
   {
    $manager = new ProduitsManager($this->link); // on crée un nouveau produitManager et on lui donne le link dont il a besoin (vers laBDD)
    $this->produits = $manager->getByPanier($this); // On appelle la fonction getByPanier qui existe dans le produitManager: "applique cette fonction
    // pour récupérer la liste des produits du panier"
    return $this->produits; //ici, la liste des produits
   }

   public function ajoutProduit(Produits $produit) // on veut un objet produit
   {
    // null ?
    if ($this->produits === null)// si pas encore rempli...
      $this->produits = $this->getProduits(); // ...on récupère la liste
      if ($this->prix === null)
      $this->prix = 0;
    if ($this->poids === null)
      $this->poids = 0;
    $i = 0;
    while ($i < sizeof($this->produits))
    {
      if ($this->produits[$i]->getId() == $produit->getId())
      {
        if ($this->produits[$i]->getQuantite() === null)
          $this->produits[$i]->setQuantite(0);
        $this->produits[$i]->setQuantite($this->produits[$i]->getQuantite()+1);
        $this->nbre_produits++;
        $produit->setPrixUniTtc();
        $this->prix = $this->prix + $produit->setPrixUniTtc();
        $this->poids = $this->poids + $produit->getPoidsUni();
        return $this->produits[$i];
      }
      $i++;
    }


    $this->produits[] = $produit; // et on prend la liste pour y ajouter le produit sélectionné
    // $this->nbre_produits++;
    if ($this->produits[$i]->getQuantite() === null)
      $this->produits[$i]->setQuantite(1);
    $this->nbre_produits = sizeof($this->produits); // le nombre de produits correspond à la taille de la liste
    $this->prix = $this->prix + $produit->setPrixUniTtc();
    $this->poids = $this->poids + $produit->getPoidsUni();
   }
   public function suppressionProduit(Produit $produit)
   {
    // null ?
    if ($this->produits === null)
      $this->getProduits();
    
    $count=0;// ce compteur est relatif à la boucle

    while($count < sizeof($this->produits)) // tant que le compteur boucle est inférieur à la taille de la liste
    {
      $article = $this->produits[$count];//article est ici UN produit de la liste, on les prend un par un
      if ($article->getId() == $produit->getId()) //$produit= celui qu'on veut enlever. On détermine l'id du produit qu'on veut retirer
      // et lorsque la boucle passe dessus...
      {
        if ($article->getQuantite() > 1)
        {
          $article->setQuantite($article->getQuantite()-1);
          $this->nbre_produits--;
        }
        else
        {
          array_splice($this->produits, $count, 1); //...on le retire (on n'en prend qu'un) $count correspondant au produit qu'on voulait enlever
          $this->nbre_produits = sizeof($this->produits); // on redéfinit la taille de la liste
        }
        $this->prix = $this->prix - $produit->getPrixUniTtc();
        $this->poids = $this->poids - $produit->getPoidsUni();
        return $this->produits;
      }
      $count++;
    }
    throw new Exception("Produit non trouvé");
    

    
    // $this->nbre_produits--;
   }

public function setIdUser($id_user){

    if(! is_int($id_user))
    {
    	throw new Exception ("veuillez entrer un chiffre") ;
    }
    
    

    	$this->id_user = $id_user;
    

}



public function setStatut($statut)
	{
		if (strlen($statut) < 5)
		{
			throw new Exception  ("veuillez entrer au moin 5 carracteres (lettres)");
		}
    else if (strlen($statut > 15))
      throw new Exception("maximum 15 caractères");
      
		$this->statut=$statut;
	}






public function setPrix($prix){

	if(! is_int($prix))
	{
		throw new Exception  ('veuillez entrer un chiffre ');
	}

	$this->prix = $prix ;


	
}


public function setNombreProduits($nbre_produits){

	if(! is_int($nbre_produits))
	{
		throw new Exception  ("veuillez entrer un chiffre");
	}

	$this ->nbre_produits = $nbre_produits;


	
}

public function setPoids($poids){

	if(! is_int($poids))
	{
		throw new Exception  ("veuillez entrer un chiffre");
	}

	$this ->poids = $poids;







	
}









}
/*
$panier = $panierManager->getByUser($_SESSION['id']);
$produit = $produitManager->getById(3);
// $produit->getStock() > 0
$panier->ajoutProduit($produit);
$panierManager->update($panier);
*/

?>






