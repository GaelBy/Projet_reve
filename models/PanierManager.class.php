+<?php


class PanierManager

{
	


	private $link;
	// les autorisations et certaines vérifs sont faites au traitement_user.php
	//ci-dessous, le lien à la base de données via l'index
	public function __construct($link)
	{
		$this->link = $link;
	}


    
	public function getById($id)
	{
		//ci-dessous, on transforme $id en entier
		$id=intval($id);
		// $query est la requête: on va chercher l'id dans la bdd
		$query="SELECT * FROM panier WHERE id=".$id;
		//on applique la requête:
		$res= mysqli_query($this->link,$query);
		//on définit la variable user et on "l'envoie" dans l'objet user
		$panier=mysqli_fetch_object($res,"Panier",[$this->link]);
		return $panier;
	}


	public function getByIdUser($id_user)
	{
		//ci-dessous, on transforme $id en entier
		$id_user=intval($id_user);
		// $query est la requête: on va chercher l'id dans la bdd
		$list = [];
		$query="SELECT * FROM panier WHERE id_user=".$id_user;
		//on applique la requête:
		$res= mysqli_query($this->link,$query);
		//on définit la variable user et on "l'envoie" dans l'objet user
		while($panier_user = mysqli_fetch_object($res,"Panier",[$this->link]))
		{
			$list[] = $panier_user;
		}

		return $list;
	}
	public function getCurrent()//pas d'intérêt sous cette forme, voir plus précisément
	{
		//ci-dessous, on transforme $id en entier
		$id_user=intval($_SESSION['id']);
		// $query est la requête: on va chercher l'id dans la bdd
		$query="SELECT * FROM panier WHERE id=".$id_user;
		//on applique la requête:
		$res= mysqli_query($this->link,$query);
		//on définit la variable user et on "l'envoie" dans l'objet user
		$panier_user=mysqli_fetch_object($res,"Panier",[$this->link]);
		return $panier_user;
	}


	public function getByStatut($statut)
	{
		$statut=mysqli_real_escape_string($this->link, $statut);
		$list = [];
		$query="SELECT * FROM panier WHERE statut=".$statut;
		//on applique la requête:
		$res= mysqli_query($this->link,$query);
		//on définit la variable user et on "l'envoie" dans l'objet user
		while ($panier=mysqli_fetch_object($res,"Panier",[$this->link]));
			$list[] = $panier;
		return $list;
	}



   public function create($data)
   {
		$panier = new Panier($this->link) ;
    	if (!isset($data['id_user'])) //n'est pas set
		{
			throw new Exception("Paramètre manquant:id_user"); //NB:VOIR TRAITEMENT!
		}
		if (!isset($data['statut']))
		{
			throw new Exception("Paramètre manquant: statut");
		}
		if (!isset($data['prix']))
		{
			throw new Exception("Paramètre manquant: prix");
		}
		if (!isset($data['nombre_produits']))
		{
			throw new Exception("Paramètre manquant: nombre_produits");
		}
		if (!isset($data['poids']))
		{
			throw new Exception("Paramètre manquant: poids");
		}
		


        $panier->setIdUser($data['id_user']);
		$panier->setStatut($data['statut']);
		$panier->setPrix($data['prix']);
		$panier->setNombreProduits($data['nombre_produits']);
		$panier->setPoids($data['poids']);


		$id_user= intval($panier->getIdUser());
		$statut= mysqli_real_escape_string($this->link,$panier->getStatut());
		$prix= mysqli_real_escape_string($this->link,$panier->getPrix());
		$nombre_produits= mysqli_real_escape_string($this->link,$panier->getNombreProduits());
        $poids= mysqli_real_escape_string($this->link,$panier->getPoids());


        $query="INSERT INTO panier (id_user,statut,prix,nbre_produits,poids) 
				VALUES ('".$id_user."', '".$statut."','".$prix."','".$nombre_produits."','".$poids."')";
		$res=mysqli_query($this->link,$query);
		// on vérifie que la requête s'est bien exécutée:
		if($res)
		{
			$id=mysqli_insert_id($this->link); // on récupère le dernièr id 
			if($id)
			{
				$panier=$this->getById($id); // on récupère l'user qui correspond à l'id
				$list = $panier->getProduits();
				if (!empty($list))
				{
					$produit = $list[0];
					$query = "INSERT INTO link_panier_produits (id_panier, id_produit, quantite)
					VALUES ('".$id."', '".$produit->getId()."', '".$produit->getQuantite()."')";
					$res = mysqli_query($link, $query);
				}
				return $panier;
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
		




   public function update(Panier $panier)
	{
		//NB: mysqli etc...a toujours besoin du link et du string)
		$id=$panier->getId();
		$list = $panier->getProduits();
		// link_panier_produits
		// DELETE
		$query = "DELETE FROM link_panier_produits WHERE id_panier=".$id;
		$res = mysqli_query($this->link, $query);
		// INSERT
		$i = 0;
		while ($i < sizeof($list))
		{
			$produit = $list[$i];
			$query = "INSERT INTO link_panier_produits (id_panier, id_produit, quantite)
			VALUES ('".$id."', '".$produit->getId()."', '".$produit->getQuantite()."')";
			$res = mysqli_query($this->link, $query);
			$i++;
		}
		$id_user= mysqli_real_escape_string($this->link,$panier->getIdUser());
		$statut= mysqli_real_escape_string($this->link,$panier->getStatut());
		$prix= mysqli_real_escape_string($this->link,$panier->getPrix());
		$nombre_produits= mysqli_real_escape_string($this->link,$panier->getNombreProduits());
        $poids= mysqli_real_escape_string($this->link,$panier->getPoids());
		$query="UPDATE panier SET
	    id_user ='".$id_user."',
		statut ='".$statut."',
		prix='".$prix."',
		nbre_produits='".$nombre_produits."',
		poids ='".$poids."',
		statut='".$statut."' WHERE id=".$id;
		$res=mysqli_query($this->link,$query);
		if ($res)
		{
			return $this->getById($id);
		}
		else
		{
			throw new Exception("Erreur Interne");
			
		}
		/*
		id id_panier id_produit quantite
		-- 1
		-- 2
		-- 3
		$this->produits = array(Produit1, Produit2, Produit3);
		$panier->ajoutProduit($produit4);
		$panier->supprimerProduit($produit2);
		$this->produits = array(Produit1, Produit3, Produit4);
		id id_panier id_produit quantite
		*/
		/*$query = "DELETE FROM link_panier_produits WHERE id_panier=".$id;
		while ()
		{
			$produit = $this->produits[0];
			$query = "INSERT INTO link_panier_produits (id_panier, id_produit, quantite) VALUES('".$id."', '".$produit->getId()."', '1')";
		}*/
		/*
		id id_panier id_produit quantite
		-- 1
		-- 3
		-- 4
		*/
	}

		public function delete(Panier $panier) //NB: on ne delete pas, on passe le statut à 0, on le cache
	{
		$id=$panier->getId();
		$statut=0; // puisque par défaut, dans le create, on l'a défini à 1
		$query="UPDATE panier SET statut='".$statut."' WHERE id=".$id;
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


















}



?>