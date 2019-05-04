<?php 
namespace App\Src\Entity;

class Comment
{
	private $ID;
	private $author;
	private $dateComment;
	private $content;
	private $reportStatus;

	public function getID()
	{
		return $this->ID;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getDateComment()
	{
		return $this->dateComment;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getReportStatus()
	{
		return $this->reportStatus;
	}

	public function setID($ID)
	{
		$this->ID = $ID;
	}

	public function setAuthor($author)
	{
		$this->author = $author;
	}

	public function setDateComment($dateComment)
	{
		$this->dateComment = $dateComment;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}

	public function setReportStatus($reportStatus)
	{
		$this->reportStatus = $reportStatus;
	}
}