<?php 
namespace App\Src\Managers;
use App\Src\Models\Article;


class ArticleManager extends DataBaseManager
{
	private function buildObject($row)
	{
		$article = new Article();
		$article->setID($row["ID"]);
		$article->setTitle($row["title"]);
		$article->setAuthor($row["author"]);
		$article->setDatePost($row["datePost"]);
		$article->setContent($row["content"]);
		return $article;
	}

	public function getArticles()
	{
		$sql = 
			"SELECT ID, title, author, content, datePost
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