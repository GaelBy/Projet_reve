<?php
class AvisManager
{
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	public function getById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM avis WHERE id=".$id." ORDER BY `date`";
		$res = mysqli_query($this->link, $query);
		$avis = mysqli_fetch_object($res, "Avis", [$this->link]);
		return $avis;
	}
	public function getByAuthor($id_author)
	{
		$id_author = intval($id_author);
		$list = [];
		$query = "SELECT * FROM avis WHERE id_author=".$id_author;
		$res = mysqli_query($this->link, $query);
		while ($avis = mysqli_fetch_object($res, "Avis", [$this->link]))
			$list[] = $avis;
		return $list;
	}
	public function getByProduit($id_produit)
	{
		$id_produit = intval($id_produit);
		$list = [];
		$query = "SELECT * FROM avis WHERE id_produit=".$id_produit." ORDER BY `date`";
		$res = mysqli_query($this->link, $query);
		while ($avis = mysqli_fetch_object($res, "Avis", [$this->link]))
			$list[] = $avis;
		return $list;
	}
	public function getAll()
	{
		$list = [];
		$query = "SELECT * FROM avis ORDER BY `date`";
		$res = mysqli_query($this->link, $query);
		while ($avis = mysqli_fetch_object($res, "Avis", [$this->link]))
			$list[] = $avis;
		return $list;
	}
	public function create($data, Produits $produit, User $user)
	{
		$avis = new Avis($this->link);
		if (!isset($data['content']))
			throw new Exception("Paramètre manquant: contenu");
		if (!isset($data['note']))
			throw new Exception("Paramètre manquant: note");

		$avis->setAuthor($user);
		$avis->setProduit($produit);
		$avis->setContent($data['content']);
		$avis->setNote($data['note']);
		$avis->setStatut(1);

		$id_author = intval($avis->getAuthor()->getId());
		$id_produit = intval($avis->getProduit()->getId());
		$content = mysqli_real_escape_string($this->link, $avis->getContent());
		$note = intval($avis->getNote());
		$statut = $avis->getStatut();
		$query = "INSERT INTO avis (id_author, id_produit, content, note, statut)
		VALUES ('".$id_author."', '".$id_produit."', '".$content."', '".$note."', '".$statut."')";
		$res = mysqli_query($this->link, $query);
		if ($res)
		{
			$id = mysqli_insert_id($this->link);
			if ($id)
			{
				$avis = $this->getById($id);
				return $avis;
			}
			else
				throw new Exception("Erreur interne");
		}
		else
			throw new Exception("Erreur interne");
	}
	public function update(Avis $avis)
	{
		$id = $avis->getId();
		$content = mysqli_real_escape_string($this->link, $avis->getContent());
		$note = intval($avis->getNote());
		$query = "UPDATE avis SET content='".$content."', note='".$note."'
		WHERE id=".$id;
		$res = mysqli_query($this->link, $query);
		if ($res)
			return $this->getById($id);
		else
			throw new Exception("Erreur interne");
	}
	public function delete(Avis $avis)
	{
		$id = $avis->getId();
		$statut = 0;
		$query = "UPDATE avis SET statut='".$statut."' WHERE id=".$id;
		$res = mysqli_query($this->link, $query);
		if ($res)
			return $this->getById($id);
		else
			throw new Exception("Erreur interne");
	}
}
?>