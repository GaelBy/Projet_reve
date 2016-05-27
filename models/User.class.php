<?php
class User
{
	//propriétés
	private $id;
	private $nom;
	private $prenom;
	private $email;
	private $password;
	private $date_inscription;
	private $date_naissance;
	private $telephone;
	private $statut;
	private $sexe;
	private $login;
	private $admin; // NB: on a défini "0" dans la base de données: par défaut=>pas admin

	//méthodes
	//fonction suivante: lorsque appelée, va sortir l'Id de cet objet
	public function getId()
	{
		return $this->id;
	}
	public function getNom()
	{
		return $this->nom;
	}
	public function getPrenom()
	{
		return $this->prenom;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function getDateInscription()
	{
		return $this->date_inscription;
	}
	public function getDateNaissance()
	{
		return $this->date_naissance;
	}
	public function getTelephone()
	{
		return $this->telephone;
	}
	public function getStatut()
	{
		return $this->statut;
	}
	public function getSexe()
	{
		return $this->sexe;
	}
	public function getLogin()
	{
		return $this->login;
	}
	public function getAdmin()
	{
		return $this->admin;
	}

	//on définit les Set
	//avec l'instruction suivante, on rentre le nom de la personne dans l'objet
	public function setNom($nom)
	{
		if (strlen($nom)<2)
		{
			throw new Exception("Nom trop court (<2)");
		}
		else if (strlen($nom)>15)
		{
			throw new Exception("Nom trop long (>15)");
		}
		//on donne la valeur de la variable $nom à la partie "nom" de cet objet
		$this->nom = $nom;
	}

	public function setPrenom($prenom)
	{
		if (strlen($prenom)<2)
		{
			throw new Exception("Prénom trop court (<2)");
		}
		else if (strlen($prenom)>15)
		{
			throw new Exception("Prénom trop long (>15)");
		}
	
		$this->prenom = $prenom;
	}



	public function setEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL) == false)
		{
			throw new Exception("Ce n'est pas une adresse mail");
		}
		
		$this->email = $email;
	}

	public function setPassword($password)
	{
		if(strlen($password)<5)
		{
			throw new Exception("Mot de passe trop court (<5)");
		}
		// on va mettre dans l'objet le hash du pass en utilisant la méthode Password_bcrypt, avec le tableau d'options où on définit l'option Coût.
		$this->password=password_hash($password,PASSWORD_BCRYPT, array("cost"=>8));
	}

	public function setDateNaissance($date_naissance)
	{
		//on récupère le jour, le mois et l'année. $dateArray parce qu'on récupère en fait les infos sous forme de tableau
		$dateArray= date_parse_from_format(d/m/Y, $date_naissance);

		// je vérifie dans le tableau "dateArray" (Pour la fonction, "month", "day" et "year" doivent être des Int)
		if (checkdate($dateArray["month"],$dateArray["day"],$dateArray["year"])==FALSE)
		{
			throw new Exception("Ce n'est pas une date de naissance!");
		}

		//Ce qui va être rentré dans l'objet sous forme de Timestamp (mktime convertit le tableau en timestamp)
		$this->date_naissance = mktime(0,0,0, $dateArray["month"], $dateArray["day"], $dateArray["year"]);
	}

	public function setTelephone($telephone)
	{
		//avec utilisation d'une expression régulière (à creuser):
		if (preg_match("#0[1-9]([-. ]?[0-9]{2}){4}$#",$telephone)==FALSE)
		{
			throw new Exception("Ce n'est pas un numéro de téléphone valide");
		}

		$this->telephone=$telephone;
	}

	public function setStatut($statut)
	{
		if (is_bool($statut)==FALSE)
		{
			throw new Exception("Ce n'est pas un booléen");
		}

		$this->statut=$statut;
	}

	public function setSexe($sexe)
	{
		if ($sexe!=1 && $sexe!=2)
		{
			throw new Exception("Compléter champ 'sexe'");
		}

		$this->sexe=$sexe;
	}

	public function setLogin($login)
	{
		if(strlen($login)<4)
		{
			throw new Exception("login trop court (<4)");
		}
		else if (strlen($login)>15)
		{
			throw new Exception("login trop long (>15)");
		}

		$this->login=$login;
	}

}
?>