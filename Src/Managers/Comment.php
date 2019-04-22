<?php

class Comment extends DataBase
{
	public function getCommentsArticle($articleID) 
	{
		$sql = 
			"SELECT ID, author, dateComment, content
			FROM comments
			WHERE article_ID = ?
			ORDER BY dateComment DESC";
		return $this->createRequest($sql, [$articleID]);
	}
}