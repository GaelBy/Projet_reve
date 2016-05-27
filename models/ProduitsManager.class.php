<?php
class ProduitsManager;
{
	private $link;
	public function__construct($link)
	{
		$this->link =$link;
	}

	public function getById($id) // récup produit par id
	{
		$id=intval($id);
		$query="SELECT * FROM produits WHERE id=".$id;
		$res=mysqli_query($this->link,$query);
		$produit=mysqli_fetch_object($res,"Produits");
		return $produit;
	}

	public function getByReference($reference) // récup produit par reference
	{
		$reference=mysqli_real_escape_string($this->link,$reference);
		$query="SELECT * FROM produits WHERE reference='".$reference."'";
		$res=mysqli_query($this->link,$query);
		$produit=mysqli_fetch_object($res,"Produits");
		return $produit;	
	}

	public function getByNom($nom) // récup produit par nom de produit
	{
		$nom=mysqli_real_escape_string($this->link,$nom);
		$squery="SELECT * FROM produits WHERE nom='".$nom."'";
		$res=mysqli_query($this->link,$query);
		$produit=mysqli_fetch_object($res,"Produits");
		return $produit;
	}

	// Pour entrer nouveau produit en bdd:
	public function create($data)
	{
		$produit=new Produits();
		if(!isset($data['reference']))
		{ 
			throw new Exception("Paramètre manquant: référence");	
		}
		if(!isset($data['stock']))
		{
			throw new Exception("Paramètre manquant: quantité");
		}
		if(!isset($data['prix_uni_ht']))
		{
			throw new Exception("Paramètre manquant: prix unitaire HT");			
		}
		if(!isset($data['tva']))
		{
			throw new Exception("Paramètre manquant: TVA applicable");
		}
		if(!isset($data['description']))
		{
			throw new Exception("Paramètre manquant: description");
		}
		if(!isset($data['image']))
		{
			throw new Exception("Paramètre manquant: illustration");
		}
		if(!isset($data['nom']))
		{
			throw new Exception("Paramètre manquant:nom");			
		}
		if(!isset($data['poids_uni']))
		{
			throw new Exception("Paramètre manquant: poids");
		}

		$produit->setReference($data['reference']);
		$produit->setStock($data['stock']);
		$produit->setPrixUniHt($data['prix_uni_ht']);
		$produit->setTva($data['tva']);
		$produit->setDescription($data['description']);
		$produit->setImage($data['image']);
		$produit->setNom($data['nom']);
		$produit->setPoidsUni($data['poids_uni']);
		$produit->setStatut(1);

		$reference=mysqli_real_escape_string($this->link,$produit->getReference());
		$stock=intval($produit->getStock();
		$prixUniHt=floatval($produit->getPrixUniHt();
		$tva=floatval($produit->getTva();
		$description=mysqli_real_escape_string($this->link,$produit->getDescription());
		$image=mysqli_real_escape_string($this->link,$produit->getImage());//A VOIR
		$nom=mysqli_real_escape_string($this->link,$produit->getNom());
		$poidsUni=floatval($produit->getPoidsUni();
		$statut=$produit->getStatut();

		$query="INSERT INTO produits (reference,stock,prix_uni_ht,tva,description,image,nom,poids_uni,statut) 
				VALUES ('".$reference."','".$stock."', '".$prixUniHt."','".$tva."','".$description."','".$image."','".$nom."','".$poidsUni."','".$statut."')";
		$res=mysqli_query($this->link,$query);



	}

}
?>