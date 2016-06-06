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
	private $prix_uni_ttc;
	private $quantite;

	private $prix_ttc;
	private $poids;
	private $low_stock;

	private $sub_category;
	private $avis;

	private $link;

	public function __construct($link)
	{
    	$this->link = $link;
		$this->updatePrixUniTtc();
	}
	public function getAvis() 
	{
		if ($this->avis === null)
		{
			$manager = new AvisManager($this->link);
			$this->avis = $manager->getByProduit($this->id);
		}
		return $this->avis;
	}
	public function getSubCategory()
	{
		if ($this->sub_category === null)
		{
			$manager = new SubCategoryManager($this->link);
			$this->sub_category = $manager->getById($this->id_sub_category);
		}
		return $this->sub_category;
	}
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

	public function getPrixUniTtc()
	{
		return $this->prix_uni_ttc;
	}
	public function getQuantite()
	{
		return $this->quantite;
	}
	public function setSubCategory(SubCategory $sub_category)
	{
		$this->id_sub_category = $sub_category->getId();
		$this->sub_category = $sub_category;
	}
	public function setReference($reference)
	{	
		if (strlen($reference)<5)
		{
			throw new Exception("Référence trop courte(<5)");
		}
		else if (strlen($reference)>15)
		{
			throw new Exception("Référence trop longue(>15)");
		}
		$this->reference=$reference;
	}


	public function setStock($stock)
	{
		// $stock = "42";
		if(!is_numeric($stock))
		{
			throw new Exception("Stock : ce n'est pas un nombre");
		}
		else if($stock<0)
		{
			throw new Exception("Le stock ne peut être négatif sur ce type de produits");
		}
		$this->stock=$stock;
	}


	public function setPrixUniHt($prix_uni_ht)
	{
		if(is_numeric($prix_uni_ht)!=TRUE)
		{
			throw new Exception("Prix uniHT : Ce n'est pas un nombre");
		}
		else if ($prix_uni_ht<=0)
		{
			throw new Exception("Le prix ne peut être nul ou négatif!");
		}
		$this->prix_uni_ht=$prix_uni_ht;
	}


	public function setTva($tva)
	{
		/*if(is_float($tva)!=TRUE)
		{
			throw new Exception("Ce n'est pas un taux");
		}*/

		/*else*/ if($tva<=0)
		{
			return "Ce taux ne peut être nul ou négatif";
		}

		$this->tva=$tva;
	}

	public function updatePrixUniTtc()
	{
		if ($this->prix_uni_ttc === null)
			$this->prix_uni_ttc = 1;
		$this->prix_uni_ttc = $this->prix_uni_ht * (1 + $this->tva);
		return $this->prix_uni_ttc;
	}

	public function setDescription($description)
	{
		if(strlen($description)<10)
		{
			throw new Exception("C'est un peu court comme description");
		}
		else if (strlen($description)>2047)
		{
			throw new Exception("C'est trop long comme description");
		}
		$this->description=$description;
	}


	public function setImage($image)
	{

		if(filter_var($image, FILTER_VALIDATE_URL)==FALSE)
		{
			throw new Exception("Ce n'est pas une image");
		}
		$this->image=$image;

	}


	public function setNom($nom)
	{
		if(strlen($nom)<5)
		{
			throw new Exception("Nom de produit trop court");
		}
		else if(strlen($nom)>31)
		{
			throw new Exception("Nom de produit trop long");
		}
		$this->nom=$nom;
	}

	
	public function setPoidsUni($poids_uni)
	{
		if(is_numeric($poids_uni)!=TRUE)
		{
			throw new Exception("Ce n'est pas un nombre");
		}
		else if($poids_uni<=0)
		{
			throw new Exception("Le poids ne peut être nul ou négatif");
		}
		$this->poids_uni=$poids_uni;
	}


	public function setStatut($statut)
	{
		if(($statut)==FALSE)
		{
			throw new Exception("Ce n'est pas un booléen");
		}
		$this->statut=$statut;
	}
	public function setQuantite($quantite)
	{
		$this->quantite = $quantite;
	}
	public function setMoyenne()
	{
		$list = $this->getAvis();
		$somme = 0;
		$i = 0;
		while ($i < sizeof($list))
		{
			$avis = $list[$i];
			$somme = $somme + $avis->getNote();
			$i++;
		}
		if ($i != 0)
		{
			$moyenne = $somme / $i;
			return $moyenne;
		}
		else
			return '0';
	}
	public function getPrixTtc()
	{
		if ($this->quantite>0)
		{
			$this->prix_ttc=$this->prix_uni_ttc*$this->quantite;
			return $this->prix_ttc;
		}
		else
		{
			throw new Exception("Ce produit n'est plus en stock");
		}
	}

	public function getPoids()
	{
		if ($this->quantite>0)
		{
			$this->poids=$this->poids_uni*$this->quantite;
			return $this->poids;			
		}
		else
		{
			throw new Exception("Ce produit n'est plus en stock");//A vérifier nécessité de mettre cettefonction
		}
	}
}
?>
