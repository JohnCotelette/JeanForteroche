<?php
namespace App\Src\Managers;


class CommentManager extends DataBaseManager
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