<?php
class Avis
{
	private $id;
	private $id_author;// Numéro
	private $id_produit;
	private $content;
	private $date;
	private $note;
	private $statut;

	private $author;// Objet
	private $produit;// Objet
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	public function getAuthor()
	{
		if ($this->author === null)
		{
			$manager = new UserManager($this->link);
			$this->author = $manager->getById($this->id_author);
		}
		return $this->author;
	}
	public function getProduit()
	{
		if ($this->produit === null)
		{
			$manager = new ProduitsManager($this->link);
			$this->produit = $manager->getById($this->id_produit);
		}
		return $this->produit;
	}
	public function getId()
	{
		return $this->id;
	}
	/*
	public function getIdAuthor()
	{
		return $this->id_author;
	}
	public function getIdProduit()
	{
		return $this->id_produit;
	}
	*/
	public function getContent()
	{
		return $this->content;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function getNote()
	{
		return $this->note;
	}
	public function getStatut()
	{
		return $this->statut;
	}

	/*public function setIdAuthor($id_author)
	{
		$this->id_author = $id_author;
	}
	public function setIdProduit($id_produit)
	{
		$this->id_produit = $id_produit;
	}*/
	public function setContent($content)
	{
		if (strlen($content) < 10)
			throw new Exception("Contenu trop court (<10)");
		else if (strlen($content) > 1023)
			throw new Exception("Contenu trop long (>1023)");
		$this->content = $content;
	}
	public function setNote($note)
	{
		if (!is_int($note))
			throw new Exception("Paramètre erronné: Note");
		if ($note < 0)
			throw new Exception("Note trop basse (<0)");
		if ($note > 5)
			throw new Exception("Note trop haute (>5)");
		$this->note = $note;
	}
	public function setStatut($statut)
	{
		if (!is_bool($statut))
			throw new Exception("Ce n'est pas un booléen");
		$this->statut = $statut;
	}
}
?>