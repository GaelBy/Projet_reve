<?php
class Category
{
	private $id;
	private $description;
	private $nom;

	private $link;

	private $sub_category;


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
		else if (strlen($description)>127)
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
}
?>