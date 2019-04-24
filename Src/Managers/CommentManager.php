<?php
namespace App\Src\Managers;
use App\Src\Models\Comment;


class CommentManager extends DataBaseManager
{
	private function buildObject($row)
	{
		$comment = new Comment();
		$comment->setID($row["ID"]);
		$comment->setAuthor($row["author"]);
		$comment->setDateComment($row["dateComment"]);
		$comment->setContent($row["content"]);
		return $comment;
	}

	public function getCommentsArticle($articleID) 
	{
		$sql = 
			"SELECT ID, author, dateComment, content
			FROM comments
			WHERE article_ID = ?
			ORDER BY dateComment DESC";
		$result = $this->createRequest($sql, [$articleID]);
		$comments = [];
		forEach($result as $row)
		{
			$commentID = $row["ID"];
			$comments[$commentID] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $comments;
	}
}