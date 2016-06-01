<?php
class ProduitsManager
{
	private $link;
	public function __construct($link)
	{
		$this->link =$link;
	}
// cf composition: récupération de tous les produits qui sont dans un panier donné, ici "$panier"
	public function getByPanier(Panier $panier)
	{
		$id=$panier->getId(); //ici on récupère l'id du panier en question
		$list = [];// on prépare ici la liste des produits
		$query="SELECT * FROM produits
			INNER JOIN link_panier_produits ON produits.id=link_panier_produits.id_produit
			WHERE link_panier_produits.id_panier=".$id; // Ici , on fait une jointure entre link_panier et produits, on détermine que l'Id
			//dans link_panier est égal à celui de produits et qui doit être équivalent à l'id du panier
		$res=mysqli_query($this->link,$query);
		while($produit=mysqli_fetch_object($res,"Produits",[$this->link]))
		{
			$list[]=$produit;
		}
		return $list; // tant que...on remplit la liste
	}
	public function getById($id) // récup produit par id
	{
		$id=intval($id);
		$query="SELECT * FROM produits WHERE id=".$id;
		$res=mysqli_query($this->link,$query);
		$produit=mysqli_fetch_object($res,"Produits",[$this->link]);
		return $produit;
	}

	public function getByReference($reference) // récup produit par reference
	{
		$reference=mysqli_real_escape_string($this->link,$reference);
		$query="SELECT * FROM produits WHERE reference='".$reference."'";
		$res=mysqli_query($this->link,$query);
		$produit=mysqli_fetch_object($res,"Produits",[$this->link]);
		return $produit;	
	}

	public function getByNom($nom) // récup produit par nom de produit
	{
		$nom=mysqli_real_escape_string($this->link,$nom);
		$query="SELECT * FROM produits WHERE nom='".$nom."'";
		$res=mysqli_query($this->link,$query);
		$produit=mysqli_fetch_object($res,"Produits",[$this->link]);
		return $produit;
	}

	public function getBySubCategory($id_sub_category) // récup produit par sous catégorie
	{
		$id_sub_category=intval($id_sub_category);
		$list=[];
		$query="SELECT * FROM produits WHERE id_sub_category='".$id_sub_category."'";
		$res=mysqli_query($this->link,$query);

		while($produit=mysqli_fetch_object($res,"Produits",[$this->link]))
		{
			$list[]=$produit;
		}
		return $list;
	}


	// Pour entrer nouveau produit en bdd:
	public function create($data)
	{
		$produit=new Produits($this->link);
		if(!isset($data['id_sub_category']))
		{ 
			throw new Exception("Paramètre manquant: sous catégorie");	
		}
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

		$produit->setSubCategory($data['id_sub_category']);
		$produit->setReference($data['reference']);
		$produit->setStock($data['stock']);
		$produit->setPrixUniHt($data['prix_uni_ht']);
		$produit->setTva($data['tva']);
		$produit->setDescription($data['description']);
		$produit->setImage($data['image']);
		$produit->setNom($data['nom']);
		$produit->setPoidsUni($data['poids_uni']);
		$produit->setStatut(1);

		$sub_category = intval($produit->getIdSubCategory());
		$reference=mysqli_real_escape_string($this->link,$produit->getReference());
		$stock=intval($produit->getStock());
		$prixUniHt=floatval($produit->getPrixUniHt());
		$tva=floatval($produit->getTva());
		$description=mysqli_real_escape_string($this->link,$produit->getDescription());
		$image=mysqli_real_escape_string($this->link,$produit->getImage());//A VOIR
		$nom=mysqli_real_escape_string($this->link,$produit->getNom());
		$poidsUni=floatval($produit->getPoidsUni());
		$statut=$produit->getStatut();

		$query="INSERT INTO produits (id_sub_category, reference, stock, prix_uni_ht, tva, description,
			                image,nom,poids_uni,statut) 
				VALUES ('".$sub_category."', '".$reference."','".$stock."', '".$prixUniHt."','".$tva."',
					    '".$description."','".$image."','".$nom."','".$poidsUni."',
					    '".$statut."')";
		$res=mysqli_query($this->link,$query);
var_dump($query);
var_dump($res);
		//A VOIR:

		if($res)
		{
			$id=mysqli_insert_id($this->link); // on récupère le dernièr id 
			
			if($id)
			{
				$produit=$this->getById($id); // on récupère l'user qui correspond à l'id
				return $produit;
			}
			else
			{
				throw new Exception("Erreur interne");
			}
		}
		else
		{
			throw new Exception("Erreur interne");
			
		}

	}
	public function update(Produits $produit)
	{
		$id=$produit->getId();
		$reference=mysqli_real_escape_string($this->link,$produit->getReference());
		$stock=intval($produit->getStock());
		$prixUniHt=floatval($produit->getPrixUniHt());
		$tva=floatval($produit->getTva());
		$description=mysqli_real_escape_string($this->link,$produit->getDescription());
		$image=mysqli_real_escape_string($this->link,$produit->getImage());
		$nom=mysqli_real_escape_string($this->link,$produit->getNom());
		$poidsUni=floatval($produit->getPoidsUni());
		$statut=$produit->getStatut();

		$query="UPDATE produits SET
		reference='".$reference."',
		stock='".$stock."',
		prix_uni_ht='".$prixUniHt."',
		tva='".$tva."',
		description='".$description."',
		image='".$image."',
		nom='".$nom."',
		poids_uni='".$poidsUni."',
		statut='".$statut."' WHERE id=".$id;
		$res=mysqli_query($this->link,$query);
		if($res)
		{
			return $this->getById($id);
		}
		else
		{
			throw new Exception("Erreur Interne");
			
		}
	}
	public function delete (Produits $produit)
	{
		$id=$produit->getId();
		$statut=0;
		$query="UPDATE produits SET statut='".$statut."'WHERE id=".$id;
		$res=mysqli_query($this->link,$query);
		if($res)
		{
			return $this->getById($id);
		}
		else
		{
			throw new Exception("Erreur Interne");
		}
	}

}

?>
