<?php 
namespace App\Src\Model;
use App\Src\Framework\Database;
use App\Src\Entity\Article;

class ArticleModel extends Database
{
	private function buildObject($row)
	{
		$article = new Article();
		$article->setID($row["ID"]);
		$article->setTitleBook($row["titleBook"]);
		$article->setTitle($row["title"]);
		$article->setAuthor($row["author"]);
		$article->setDatePost($row["datePost"]);
		$article->setContent($row["content"]);
		$article->setContentCut($row["content"]);
		$article->setImageLink($row["localPicture"]);
		return $article;
	}

	public function getArticles()
	{
		$sql = 
			"SELECT ID, titleBook, title, author, content, datePost, localPicture
			FROM posts
			ORDER BY ID DESC";
		$result = $this->createRequest($sql);
		$articles = [];
		forEach($result as $row)
		{
			$articleID = $row["ID"];
			$articles[$articleID] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $articles;
	}


	public function getOneArticle($articleID)
	{
		$sql =
			"SELECT ID, title, author, content, datePost
			FROM posts
			WHERE ID = ?";
		$result = $this->createRequest($sql, [$articleID]);
		$article = $result->fetch();
		$result->closeCursor();
		return $this->buildObject($article);
	}
}