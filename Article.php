<?php 

class Article 
{
	public function getArticles()
	{
		$db = new DataBase();
		$connection = $db->getConnection();
		$result = $connection->query
			("
			SELECT ID, title, author, content, dateMessage
			FROM posts
			ORDER BY ID DESC
			");
		return $result;
	}

	public function getOneArticle()
	{
		$db = new Database();
		$connection = $db->getConnection();
		$result = $connection->prepare
			("
			SELECT ID, title, author, content, dateMessage
			FROM posts
			WHERE ID = ?
			");
		$result->execute([$articleID]);
		return $result;
	}
}