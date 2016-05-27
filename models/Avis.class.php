<?php
class Avis
{
	private $id;
	private $id_author;
	private $id_produit;
	private $content;
	private $date;
	private $note;
	private $statut;

	public function getId()
	{
		return $id;
	}
	public function getIdAuthor()
	{
		return $id_author;
	}
	public function getIdProduit()
	{
		return $id_produit;
	}
	public function getContent()
	{
		return $content;
	}
	public function getDate()
	{
		return $date;
	}
	public function getNote()
	{
		return $note;
	}
	public function getStatut()
	{
		return $statut;
	}

	public function setIdAuthor($id_author)
	{
		$this->id_author = $id_author;
	}
	public function setIdProduit($id_produit)
	{
		$this->id_produit = $id_produit;
	}
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