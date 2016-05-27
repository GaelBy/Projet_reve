<?php
class SubCategory
{
	private $id;
	private $id_category;
	private $nom;
	private $description;

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
}
?>