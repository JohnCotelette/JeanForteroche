<?php 
namespace App\Src\Models;


class Article 
{
	private $ID;
	private $title;
	private $author;
	private $datePost;
	private $content;


	public function getID()
	{
		return $this->ID;
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


	public function setID($id)
	{
		$this->ID = $id;
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
}