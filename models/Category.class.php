<?php
class Category
{
	private $id;
	private $description;
	private $nom;

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

	public function setDescription($description)
	{
		if(strlen($description)<10)
		{
			throw new Exception("Description trop courte !");
		}
		else if (strlen($description)>2047)
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
		else if (strlen($nom)>30)
		{
			throw new Exception("Nom trop longue(>30)");
		}
		$this->nom=$nom;
	}
}
?>