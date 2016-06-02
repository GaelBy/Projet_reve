<?php
class AdresseManager
{
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	public function getById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM adresses WHERE id=".$id;
		$res = mysqli_query($this->link, $query);
		$adresse = mysqli_fetch_object($res, "Adresse", [$this->link]);
		return $adresse;
	}
	public function getLivraisonByUser(User $user)
	{
		$id_user = intval($user->getId());
		$query = "SELECT * FROM adresses WHERE id_user=".$id_user." AND type_adresse='livraison'";
		$res = mysqli_query($this->link, $query);
		$adresse = mysqli_fetch_object($res, "Adresse", [$this->link]);
		return $adresse;
	}
	public function getFacturationByUser(User $user)
	{
		$id_user = intval($user->getId());
		$query = "SELECT * FROM adresses WHERE id_user=".$id_user." AND type_adresse='facturation'";
		$res = mysqli_query($this->link, $query);
		$adresse = mysqli_fetch_object($res, "Adresse", [$this->link]);
		return $adresse;
	}
	public function getByUser(User $user)
	{
		$id_user = intval($user->getId());
		$list = [];
		$query = "SELECT * FROM adresses WHERE id_user=".$id_user;
		$res = mysqli_query($this->link, $query);
		while ($adresse = mysqli_fetch_object($res, "Adresse", [$this->link]))
			$list[] = $adresse;
		return $list;
	}
	public function create($data)
	{
		$adresse = new Adresse($this->link);
		if (!isset($data['id_user']))
			throw new Exception("Paramètre manquant: user");
		if (!isset($data['nom_adresse']))
			throw new Exception("Paramètre manquant: nom");
		if (!isset($data['numero']))
			throw new Exception("Paramètre manquant: numéro");
		if (!isset($data['rue']))
			throw new Exception("Paramètre manquant: rue");
		if (!isset($data['ville']))
			throw new Exception("Paramètre manquant: ville");
		if (!isset($data['code_postal']))
			throw new Exception("Paramètre manquant: code postal");
		if (!isset($data['type_adresse']))
			throw new Exception("Paramètre manquant: type d'adresse");
		$adresse->setIdUser($data['id_user']);
		$adresse->setNom($data['nom_adresse']);
		$adresse->setNumero($data['numero']);
		$adresse->setRue($data['rue']);
		$adresse->setVille($data['ville']);
		$adresse->setCodePostal($data['code_postal']);
		$adresse->setTypeAdresse($data['type_adresse']);
		$id_user = intval($adresse->getIdUser());
		$nom = mysqli_real_escape_string($this->link, $adresse->getNom());
		$numero = mysqli_real_escape_string($this->link, $adresse->getNumero());
		$rue = mysqli_real_escape_string($this->link, $adresse->getRue());
		$ville = mysqli_real_escape_string($this->link, $adresse->getVille());
		$code_postal = intval($adresse->getCodePostal());
		$type_adresse = mysqli_real_escape_string($this->link, $adresse->getTypeAdresse());
		$query = "INSERT INTO adresses (id_user, nom, numero, rue, ville, code_postal, type_adresse)
		VALUES ('".$id_user."', '".$nom."', '".$numero."', '".$rue."', '".$ville."', '".$code_postal."', '".$type_adresse."')";
		$res = mysqli_query($this->link, $query);
		if ($res)
		{
			$id = mysqli_insert_id($this->link);
			if ($id)
			{
				$adresse = $this->getById($id);
				return $adresse;
			}
			else
				throw new Exception("Erreur interne");
		}
		else
			throw new Exception("Erreur interne");
	}
	public function update(Adresse $adresse)
	{
		$id = $adresse->getId();
		$nom = mysqli_real_escape_string($this->link, $adresse->getNom());
		$numero = mysqli_real_escape_string($this->link, $adresse->getNumero());
		$rue = mysqli_real_escape_string($this->link, $adresse->getRue());
		$ville = mysqli_real_escape_string($this->link, $adresse->getVille());
		$code_postal = intval($adresse->getCodePostal());
		$type_adresse = mysqli_real_escape_string($this->link, $adresse->getTypeAdresse());
		$query = "UPDATE adresses SET 
		nom='".$nom."', numero='".$numero."', rue='".$rue."', 
		ville='".$ville."', code_postal='".$code_postal."', type_adresse='".$type_adresse."'
		WHERE id=".$id;
		$res = mysqli_query($this->link, $query);
		if ($res)
			return $this->getById($id);
		else
			throw new Exception("Erreur interne");
	}
}
?>