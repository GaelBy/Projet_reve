<?php
class SubCategory
{
	private $id;
	private $id_category;
	private $nom;
	private $description;
	private $produits;
	private $statut;

	private $category;
	private $link;

	public function __construct($link)
   {
    $this->link = $link;
   }

	public function getCategories()
	{
		if ($this->category === null)
		{
			$manager = new CategoryManager($this->link);
			$this->category = $manager->getById($this->id_category);
		}
		return $this->category;
	}
	public function getId()
	{
		return $this->id;
	}
	public function getIdCategory()
	{
		return $this->id_category;
	}
	public function getNom()
	{
		return $this->nom;
	}
	public function getDescription()
	{
		return $this->description;
	}
	public function getProduits()
	{
		if ($this->produits === null)
		{
			$manager = new ProduitsManager($this->link);
			$this->produits = $manager->getBySubCategory($this);
		}
		return $this->produits;
	}
	public function getStatut()
	{
		return $this->statut;
	}
	public function setNom($nom)
	{	
		if (strlen($nom)<2)
		{
			throw new Exception("Nom trop court(<2)");
		}
		else if (strlen($nom)>15)
		{
			throw new Exception("Nom trop longue(>15)");
		}
		$this->nom=$nom;
	}

	public function setDescription($description)
	{
		if(strlen($description)<10)
		{
			throw new Exception("Description trop courte !");
		}
		else if (strlen($description)>127)
		{
			throw new Exception("Description trop longue !");
		}
		$this->description=$description;
	}
	public function setIdCategory($id_category)
	{
		if(intval($id_category) != $id_category)
			throw new Exception("Paramètre incorrect: catégorie");
		$this->id_category = $id_category;
	}
	public function setCategory(Category $category)
	{
		$this->id_category = $category->getId();
		$this->category = $category;
	}
	public function setStatut($statut)
	{
		if(($statut)==FALSE)
		{
			throw new Exception("Ce n'est pas un booléen");
		}
		$this->statut=$statut;
	}
}
?>