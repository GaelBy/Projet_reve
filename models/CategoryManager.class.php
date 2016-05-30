<?php
class CategoryManager;
{
	private $link;

	public function_construct($link)
	{
		$this->link = $link;
	}

	public function getById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM category WHERE id =".$id;
		$res = mysqli_query($this->link, $query);
		$category = mysqli_fetch_object($category, "Category", [$this->link]);
		return $category;
	}


	public function getByIdCategory($id_category)
	{
		$id_category = intval($id_category);
		$query = "SELECT * FROM category WHERE id =".$id_category;
		$res = mysqli_query($this->link, $query);
		$category = mysqli_fetch_object($category, "Category", [$this->link]);
		return $category;
	}

	public function getByDescription($description)
	{
		$description = mysqli_real_escape_string($this->link, $description);
		$query = "SELECT * FROM category WHERE description =".$description;
		$res = mysqli_query($this->link, $query);
		$category = mysqli_fetch_object($category, "Category", [$this->link]);
		return $category;
	}

	public function getByNom($nom)
	{
		$description = mysqli_real_escape_string($this->link, $nom);
		$query = "SELECT * FROM category WHERE nom =".$nom;
		$res = mysqli_query($this->link, $query);
		$category = mysqli_fetch_object($category, "Category", [$this->link]);
		return $category;
	}

	public function create($data)
	{
		$category = new Category($this->link);
		if (!isset($data['description']))
			throw new Exception("Paramètre manquant: description");
		if (!isset($data['nom']))
			throw new Exception("Paramètre manquant: nom");
		$category->setDescription($data['description']);
		$category->setNom($data['nom']);
		$id = intval($category->getId());
		$description = mysqli_real_escape_string($this->link, $category->getDescription());
		$nom = mysqli_real_escape_string($this->link, $category->getNom());
		$query = "INSERT INTO category (description, nom) VALUES ('".$description."', '".$nom."')";
		$res = mysqli_query($this->link, $query);
		if ($res)
		{
			$id = mysqli_insert_id($this->link);
			if ($id)
			{
				$category = $this->getById($id);
				return $category;
			}
			else
				throw new Exception("Erreur interne");
		}
		else
			throw new Exception("Erreur interne");
	}
	public function update(Category $category)
	{
		$id = $category->getId;
		$nom = mysqli_real_escape_string($this->link, $category->getNom());
		$description = mysqli_real_escape_string($this->link, $category->getDescription());
		$query = "UPDATE category SET nom='".$nom."', description='".$description."'
		WHERE id=".$id;
		$res = mysqli_query($this->link, $query);
		if ($res)
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