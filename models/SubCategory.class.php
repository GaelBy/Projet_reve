<?php
class SubCategory
{
	private $id;
	private $id_category;
	private $nom;
	private $description;
	private $produits;


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
		$manager = new ProduitsManager($this->link);
		$this->produits = $manager->getBySubCategory($this);
		return $this->produits;
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
		if(!is_int($id_category))
			throw new Exception("Paramètre incorrect: catégorie");
		$this->id_category = $id_category;
	}
}
?>