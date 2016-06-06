<?php
class CategoryManager
{
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	public function getById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM category WHERE id =".$id;
		$res = mysqli_query($this->link, $query);
		$category = mysqli_fetch_object($res, "Category", [$this->link]);
		return $category;
	}


	public function getByCategory(Category $category)
	{
		$id_category = intval($category->getId());
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

    public function getAll()
	{
		$list = [];
		$query = "SELECT * FROM category";
		$res = mysqli_query($this->link, $query);
		while ($lsCategory = mysqli_fetch_object($res, "Category", [$this->link]))
	    
			$list[] = $lsCategory;
		
		return $list;
	}

	public function getByNom($nom)
	{
		$nom = mysqli_real_escape_string($this->link, $nom);
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
		$description = mysqli_real_escape_string($this->link, $category->getDescription());
		$nom = mysqli_real_escape_string($this->link, $category->getNom());
		$category->setImage($data['image']);
		$image=mysqli_real_escape_string($this->link,$category->getImage());
		$category->setStatut(1);
		$statut=$category->getStatut();

		$query = "INSERT INTO category (description, nom, image,statut) VALUES ('".$description."', '".$nom."','".$image."','".$statut."')";
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
		$id = $category->getId();
		$nom = mysqli_real_escape_string($this->link, $category->getNom());
		$description = mysqli_real_escape_string($this->link, $category->getDescription());
		$image=mysqli_real_escape_string($this->link,$category->getImage());
		$query = "UPDATE category SET nom='".$nom."', description='".$description."', image='".$image."' WHERE id=".$id;
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
	//Peut-être qu'il faudrait un delete de category? Voir pour rajouter un statut en BDD? Que prévoir pour les sub_cat qui s'y rattachent?
	
	public function delete (Category $category)
	{
		$id=$category->getId();
		$statut=0;
		$query="UPDATE category SET statut='".$statut."'WHERE id=".$id;
		$res=mysqli_query($this->link,$query);
		if($res)
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