<?php
class Adresse
{
	private $id;
	private $id_user;
	private $nom;
	private $numero;
	private $rue;
	private $ville;
	private $code_postal;
	private $type_adresse;

	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	public function getId()
	{
		return $this->id;
	}
	public function getIdUser()
	{
		return $this->id_user;
	}
	public function getNom()
	{
		return $this->nom;
	}
	public function getNumero()
	{
		return $this->numero;
	}
	public function getRue()
	{
		return $this->rue;
	}
	public function getVille()
	{
		return $this->ville;
	}
	public function getCodePostal()
	{
		return $this->code_postal;
	}
	public function getTypeAdresse()
	{
		return $this->type_adresse;
	}

	public function setIdUser($id_user)
	{
		$this->id_user = $id_user;
	}
	public function setNom($nom)
	{
		if (strlen($nom) < 3)
			throw new Exception("Nom d'adresse trop court (<3)");
		else if (strlen($nom) > 15)
			throw new Exception("Nom d'adresse trop long (>15)");
		$this->nom = $nom;			
	}
	public function setNumero($numero)
	{
		if (strlen($numero) > 7)
			throw new Exception("Numéro de téléphone trop long");
		$this->numero = $numero;
	}
	public function setRue($rue)
	{
		if (strlen($rue) < 5)
			throw new Exception("Nom de rue trop court (<5)");
		else if (strlen($rue >31))	
			throw new Exception("Nom de rue trop long (>31)");
		$this->rue = $rue;	
	}
	public function setVille($ville)
	{
		if (strlen($ville) > 31)
			throw new Exception("Nom de ville trop long (>31)");
		$this->ville = $ville;
	}
	public function setCodePostal($code_postal)
	{
		if (!preg_match("#[0-9]{5}$#", $code_postal))
			throw new Exception("Ce n'est pas un code postal");
		$this->code_postal = $code_postal;
	}
	public function setTypeAdresse($type_adresse)
	{
		if ($type_adresse != "facturation" && $type_adresse != "livraison")
			throw new Exception("Paramètre erronné: type d'adresse");
		$this->type_adresse = $type_adresse;
			
	}
}
?>