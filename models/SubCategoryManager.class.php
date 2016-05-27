<?php
class SubCategoryManager
{
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	public function getById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM sub_category WHERE id =".$id;
		$res = mysqli_query($this->link, $query);
		$sub_category = mysqli_fetch_object($sub_category, "SubCategory", [$this->link]);
		return $sub_category;
	}

	public function getByIdCategory($id_category)
	{
		$id_category = intval($id_category);
		$query = "SELECT * FROM sub_category WHERE id =".$id_category;
		$res = mysqli_query($this->link, $query);
		$sub_category = mysqli_fetch_object($sub_category, "SubCategory", [$this->link]);
		return $sub_category;
	}

	public function getByDescription($description)
	{
		$description = mysqli_real_escape_string($this->link, $description);
		$query = "SELECT * FROM sub_category WHERE description =".$description;
		$res = mysqli_query($this->link, $query);
		$sub_category = mysqli_fetch_object($category, "SubCategory", [$this->link]);
		return $sub_category;
	}

	public function getByNom($nom)
	{
		$description = mysqli_real_escape_string($this->link, $nom);
		$query = "SELECT * FROM category WHERE nom =".$nom;
		$res = mysqli_query($this->link, $query);
		$sub_category = mysqli_fetch_object($sub_category, "SubCategory", [$this->link]);
		return $sub_category;
	}

	public function create($data)
	{
		$sub_category = new SubCategory($this->link);
		if (!isset($data['id']))
			throw new Exception("Paramètre manquant: id");
		if (!isset($data['description']))
			throw new Exception("Paramètre manquant: description");
		if (!isset($data['nom']))
			throw new Exception("Paramètre manquant: nom");
		$sub_category->setId($data['id']);
		$sub_category->setDescription($data['description']);
		$sub_category->setNom($data['nom']);
		$id = intval($sub_category->getId());
		$description = mysqli_real_escape_string($this->link, $sub_category->getDescription());
		$nom = mysqli_real_escape_string($this->link, $sub_category->getNom());
		$query = "INSERT INTO SubCategory (id_category, description, nom) VALUES ( '".$id_category."', '".$description."', '".$nom."')";
		//$res = mysqli_query()
		$res = mysqli_query($this->link, $query);
		if ($res)
		{
			$id = mysqli_insert_id($this->link);
			if ($id)
			{
				$sub_category = $this->getById($id);
				return $sub_category;
			}
			else
				throw new Exception("Erreur interne");
		}
		else
			throw new Exception("Erreur interne");
    }

  }
?>