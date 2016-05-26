<?php
class UserManager
{
	private $link;
	// les autorisations et certaines vérifs sont faites au traitement_user.php
	//ci-dessous, le lien à la base de données via l'index
	public function __construct($link)
	{
		$this->link = $link;
	}
	// dans le manager, on travaille en direct avec la BDD
	
	public function getById($id)
	{
		//ci-dessous, on transforme $id en entier
		$id=intval($id);
		// $query est la requête: on va chercher l'id dans la bdd
		$query="SELECT * FROM users WHERE id=".$id;
		//on applique la requête:
		$res= mysqli_query($this->link,$query);
		//on définit la variable user et on "l'envoie" dans l'objet user
		$user=mysqli_fetch_object($res,"User");
		return $user;
	}

	public function getByLogin($login)
	{
		//permet de sécuriser et de permettre certains caractères spéciaux ' ""'
		// la fonction a besoin de la bdd (via le link), et de ce que je veux sécuriser: le login
		$login=mysqli_real_escape_string($this->link,$login);
		$query="SELECT * FROM users WHERE login='".$login."'";
		$res=mysqli_query($this->link,$query);
		//on récupère l'user, avec un login donné
		$user=mysqli_fetch_object($res,"User");
		return $user;
	}
	//on va entrer un nouvel utilisateur en bdd
	public function create($data)
	{
		$user=new User();
		// on va commencer à vérifier si les champs du formulaire de register sont Set:
		if (!isset($data['nom'])) //n'est pas set
		{
			throw new Exception("Paramètre manquant:nom"); //NB:VOIR TRAITEMENT!
		}
		if (!isset($data['prenom']))
		{
			throw new Exception("Paramètre manquant: prénom");
		}
		if (!isset($data['email']))
		{
			throw new Exception("Paramètre manquant: email");
		}
		//on vérifie que les deux password existent
		if (!isset($data["password"],$data["passwordBis"]))
		{
			throw new Exception("Paramètre manquant: password");
		}

		//on vérifie si les deux pass sont similaires:
		if ($data['password']!= $data['passwordBis'])
		{
			throw new Exception("Les passwords ne correspondent pas");			
		}

		if (!isset($data['date_naissance']))
		{
			throw new Exception("Paramètre manquant: date de naissance");
		}

		if (!isset($data['telephone']))
		{
			throw new Exception("Paramètre manquant: numéro de téléphone");
		}

		if (!isset($data['sexe']))
		{
			throw new Exception("Paramètre manquant: genre");
		}

		if (!isset($data['login']))
		{
			throw new Exception("Paramètre manquant: login");
		}
		//on "rentre dans l'objet"
		//on "complète" l'objet user avec les paramètres qu'on a post
		$user->setNom($data['nom']);
		$user->setPrenom($data['prenom']);
		$user->setEmail($data['email']);
		$user->setPassword($data['password']);
		$user->setDateNaissance($data['date_naissance']);
		$user->setTelephone($data['telephone']);
		$user->setStatut(1);
		$user->setSexe($data['sexe']);
		$user->setLogin($data['login']);


		// on va injecter en base de données:
		//1) On redéfinit les variables en "getant" dans l'objet, avant de les envoyer en bdd
		$nom= mysqli_real_escape_string($this->link,$user->getNom());
		$prenom= mysqli_real_escape_string($this->link,$user->getPrenom());
		$email= mysqli_real_escape_string($this->link,$user->getEmail());
		$password= mysqli_real_escape_string($this->link,$user->getPassword());
		$dateNaissance=intval($user->getDateNaissance());
		$telephone= mysqli_real_escape_string($this->link,$user->getTelephone());
		$statut=$user->getStatut();
		$sexe=intval($user->getSexe());
		$login= mysqli_real_escape_string($this->link,$user->getLogin());

		//2)On fait la requête:
		$query="INSERT INTO users (nom,prenom,email,password,date_naissance,telephone,statut,sexe,login) 
				VALUES ('".$nom."','".$prenom."', '".$email."','".$password."','".$dateNaissance."','".$telephone."','".$statut."','".$sexe."','".$login."')";
		$res=mysqli_query($this->link,$query);

		// on vérifie que la requête s'est bien exécutée:
		if($res)
		{
			$id=mysqli_insert_id($this->link); // on récupère le dernièr id 
			if($id)
			{
				$user=$this->getById($id); // on récupère l'user qui correspond à l'id
				return $user;
			}
			else
			{
				throw new Exception("Erreur interne");
			}
		}
		else
		{
			throw new Exception("Erreur interne");
			
		}
	}

	// on prépare le fonctionnement de "login"

	public function login($data)
	{
		if(!isset($data['login']))
		{
			throw new Exception("Paramètre manquant:login");			
		}

		if(!isset($data['password']))
		{
			throw new Exception("Paramètre manquant: password");
		}

		//On va aller chercher le user qui a CE login, s'il y en a un. Si "non": on exécute le if
		if(($user=$this->getByLogin($data['login']))==FALSE)
		{
			throw new Exception("Login inexistant");
		}

		if(password_verify($data['password'],$user->getPassword()==FALSE)
		{
			throw new Exception("Password incorrect");
		}

		if($user->getStatut==0)
		{
			throw new Exception("Statut inactif");
		}

		return $user;
	}
	//fonction de modification. Dans le traitement on récupère un user, on le modifie, on l'update ici, puis on le renvoie en bdd
	public function update(User $user)
	{
		//NB: mysqli etc...a toujours besoin du link et du string)
		$id=$user->getId();
		$nom= mysqli_real_escape_string($this->link,$user->getNom());
		$prenom= mysqli_real_escape_string($this->link,$user->getPrenom());
		$email= mysqli_real_escape_string($this->link,$user->getEmail());
		$password= mysqli_real_escape_string($this->link,$user->getPassword());
		$dateNaissance=intval($user->getDateNaissance());
		$telephone= mysqli_real_escape_string($this->link,$user->getTelephone());
		$statut=$user->getStatut();
		$sexe=intval($user->getSexe());
		$login= mysqli_real_escape_string($this->link,$user->getLogin());

		$query="UPDATE users SET
		nom='".$nom."',
		prenom='".$prenom."',
		email='".$email."',
		password='".$password."',
		date_naissance='".$dateNaissance."',
		telephone='".$telephone."',
		statut='".$statut."',
		sexe='".$sexe."',
		login='".$login."' WHERE id=".$id;
		$res=mysqli_query($this->link,$query);
		if ($res)
		{
			return $this->getById($id);
		}
		else
		{
			throw new Exception("Erreur Interne");
			
		}

	}
	public function delete(User $user) //NB: on ne delete pas, on passe le statut à 0, on le cache
	{
		$id=$user->getId();
		$statut=0; // puisque par défaut, dans le create, on l'a défini à 1
		$query="UPDATE users SET statut='".$statut."' WHERE id=".$id;
		$res=mysqli_query($this->link,$query);
		if ($res)
		{
			return $this->getById($id);
		}
		else
		{
			throw new Exception("Erreur Interne");
		}
	}
























?>