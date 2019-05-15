<?php 
namespace App\Src\Model;
use App\Src\Framework\Model;
use App\Src\Entity\Article;

class ArticleModel extends Model
{
	private function buildObject($row)
	{
		$article = new Article();
		$article->setID($row["ID"]);
		$article->setTitleBook($row["titleBook"]);
		$article->setTitle($row["title"]);
		$article->setAuthor($row["author"]);
		$article->setModifiedBy($row["modifiedBy"]);
		$article->setDatePost($row["datePost"]);
		$article->setContent($row["content"]);
		$article->setImageLink($row["localPicture"]);
		return $article;
	}

	public function getArticles()
	{
		$sql = 
			"SELECT ID, titleBook, title, author, modifiedBy, content, datePost, localPicture
			FROM posts
			ORDER BY ID DESC";
		$result = $this->dataBase->createRequest($sql);
		$articles = [];
		forEach($result as $row)
		{
			$articleID = $row["ID"];
			$articles[$articleID] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $articles;
	}

	public function getOneArticle($articleID, $parameter = null)
	{
		$sql =
			"SELECT ID, titleBook, title, author, modifiedBy, content, datePost, localPicture
			FROM posts
			WHERE ID = ?";
		$result = $this->dataBase->createRequest($sql, [$articleID]);
		$article = $result->fetch();
		$result->closeCursor();
		if (!$parameter)
		{
			return $this->buildObject($article);
		}
		else
		{
			return json_encode($article);
		}
	}

	public function addArticle($title, $titleBook, $author, $content, $pictureName)
	{
		$sql =
			"INSERT INTO posts (author, titleBook, title, content, localpicture)
			VALUES ('$author', '$titleBook', '$title', '$content', '$pictureName')";
		$newArticle = $this->dataBase->createRequest($sql); 
	}

	public function updateArticle($articleID, $title, $titleBook, $content, $authorEdit, $newPictureName = null)
	{
		if ($newPictureName == null)
		{
			$sql = 
				"UPDATE posts
				SET modifiedBy = '$authorEdit', title = '$title', titleBook = '$titleBook', content = '$content' 
				WHERE ID = ?";
		}
		else
		{
			$sql =
				"UPDATE posts
				SET modifiedBy = '$authorEdit', title = '$title', titleBook = '$titleBook', content = '$content', localPicture = '$newPictureName'
				WHERE ID = ?";
		}
		$updateArticle = $this->dataBase->createRequest($sql, [$articleID]);
	}

	public function deleteArticle($articleID)
	{
		$sql = 
			"DELETE FROM posts
			WHERE ID = ?";
		$deleteArticle = $this->dataBase->createRequest($sql, [$articleID]); 
	}
}