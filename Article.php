<?php 

class Article extends DataBase
{
	public function getArticles()
	{
		$sql = 
			"SELECT ID, title, author, content, dateMessage
			FROM posts
			ORDER BY ID DESC";
		return $this->createRequest($sql);
	}


	public function getOneArticle($articleID)
	{
		$sql =
			"SELECT ID, title, author, content, dateMessage
			FROM posts
			WHERE ID = ?";
		return $this->createRequest($sql, [$articleID]);
	}
}