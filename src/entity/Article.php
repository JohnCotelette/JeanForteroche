<?php 
namespace App\Src\Entity;

class Article 
{
	private $ID;
	private $titleBook;
	private $title;
	private $author;
	private $datePost;
	private $content;
	private $contentCut;
	private $imageLink;

	public function getID()
	{
		return $this->ID;
	}

	public function getTitleBook()
	{
		return $this->titleBook;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getDatePost()
	{
		return $this->datePost;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getContentCut()
	{
		return $this->contentCut;
	}

	public function getImageLink()
	{
		return $this->imageLink;
	}

	public function setID($id)
	{
		$this->ID = $id;
	}

	public function setTitleBook($titleBook)
	{
		$this->titleBook = $titleBook;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setAuthor($author)
	{
		$this->author = $author;
	}

	public function setDatePost($datePost)
	{
		$this->datePost = $datePost;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}

	public function setContentCut($content)
	{
		$this->contentCut = mb_strimwidth($content, 0, 400, "...");
	}

	public function setImageLink($imageLink)
	{
		$this->imageLink = $imageLink;
	}
}