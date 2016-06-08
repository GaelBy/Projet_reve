<?php
class Category
{
	private $id;
	private $description;
	private $nom;

	private $link;

	private $sub_category;
	private $image;
	private $statut;


	public function __construct($link){

		$this ->link = $link;
	}

	public function getId()
	{
		return $this->id;
	}
	public function getDescription()
	{
		return $this->description;
	}
	public function getNom()
	{
		return $this->nom;
	}
	public function getImage()
	{
		return $this->image;
	}
	public function getStatut()
	{
		return $this->statut;
	}

	public function getSubCategory()
	{
		if ($this->sub_category === null)
		{
			$manager = new SubCategoryManager($this->link);
			$this->sub_category = $manager->getByCategory($this);
		}
        return $this->sub_category;

	}

	public function setDescription($description)
	{
		if(strlen($description)<10)
		{
			throw new Exception("Description trop courte !");
		}
		else if (strlen($description)>1023)
		{
			throw new Exception("Description trop longue !");
		}
		$this->description=$description;
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

	public function setImage($image)
	{
		if(filter_var($image,FILTER_VALIDATE_URL)==FALSE)
		{
			throw new exception("Ce n'est pas une image!");
		}
		$image = str_replace(['http://localhost/developpement/php/projet_reve/', 'http://localhost/projet_reve/'], '', $image);
		$this->image=$image;
	}

	public function setStatut($statut)
	{
		if($statut != 0 && $statut != 1)
		{
			throw new Exception("Ce n'est pas un booléen");
		}
		$this->statut=$statut;
	}
}
?>