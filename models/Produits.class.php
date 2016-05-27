<?php
class Produits
{
	//LES PROPRIETES
	private $id;
	private $id_sub_category;
	private $reference;
	private $stock;
	private $prix_uni_ht;
	private $tva;
	private $description;
	private $image;
	private $nom;
	private $poids_uni;
	private $statut;

	public function getId()
	{
		return $this->id;
	}

	public function getIdSubCategory()
	{
		return $this->id_sub_category;
	}

	public function getReference()
	{
		return $this->reference;
	}

	public function getStock()
	{
		return $this->stock;
	}

	public function getPrixUniHt()
	{
		return $this->prix_uni_ht;
	}

	public function getTva()
	{
		return $this->tva;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getImage()
	{
		return $this->image;
	}

	public function getNom()
	{
		return $this->nom;
	}

	public function getPoidsUni()
	{
		return $this->poids_uni;
	}

	public function getStatut()
	{
		return $this->statut;
	}


	public function setReference($reference)
	{	
		if (strlen($reference)<5)
		{
			return "Référence trop courte(<5)";
		}
		else if (strlen($reference)>5)
		{
			return "Référence trop longue(>5)";
		}
		$this->reference=$reference;
	}


	public function setStock($stock)
	{
		if(is_int($stock)!=TRUE)
		{
			return "Ne peut être qu'un nombre entier";
		}
		else if($stock<0)
		{
			return "Le stock ne peut être négatif sur ce type de produits";
		}
		$this->stock=$stock;
	}


	public function setPrixUniHt($prix_uni_ht)
	{
		if(is_numeric($prix_uni_ht)!=TRUE)
		{
			return "Ce n'est pas un nombre";
		}
		else if ($prix_uni_ht<=0)
		{
			return "Le prix ne peut être nul ou négatif!";
		}
		$this->prix_uni_ht=$prix_uni_ht;
	}


	public function setTva($tva)
	{
		if(is_float($tva)!=TRUE)
		{
			return "Ce n'est pas un taux";
		}

		else if($tva<=0)
		{
			return "Ce taux ne peut être nul ou négatif";
		}

		$this->tva=$tva;
	}


	public function setDescription($description)
	{
		if(strlen($description)<10)
		{
			return "C'est un peu court comme description";
		}
		else if (strlen($description)>2047)
		{
			return "C'est trop long comme description";
		}
		$this->description=$description;
	}


	public function setImage($image)
	{

		if(filter_var($image, FILTER_VALIDATE_URL)==FALSE)
		{
			return "Ce n'est pas une image"
		}
		$this->image=$image;

	}


	public function setNom($nom)
	{
		if(strlen($nom)<5)
		{
			return "Nom de produit trop court";
		}
		else if(strlen($nom)>31)
		{
			return "Nom de produit trop long";
		}
		$this->nom=$nom;
	}

	
	public function setPoidsUni($poids_uni)
	{
		if(is_numeric($poids_uni)!=TRUE)
		{
			return "Ce n'est pas un nombre";
		}
		else if($poids_uni<=0)
		{
			return "Le poids ne peut être nul ou négatif";
		}
		$this->poids_uni=$poids_uni;
	}


	public function setStatut($statut)
	{
		if(is_bool($statut)==FALSE)
		{
			return "Ce n'est pas un booléen";
		}
		$this->statut=$statut;
	}
	

}
