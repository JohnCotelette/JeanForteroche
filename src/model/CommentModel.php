<?php
namespace App\Src\Model;
use App\Src\Model\Model;
use App\Src\Entity\Comment;

class CommentModel extends Model
{
	private function buildObject($row)
	{
		$comment = new Comment();
		$comment->setID($row["ID"]);
		$comment->setAuthor($row["author"]);
		$comment->setDateComment($row["dateComment"]);
		$comment->setContent($row["content"]);
		$comment->setReportStatus($row["reported"]);
		return $comment;
	}

	public function getCommentsArticle($articleID) 
	{
		$sql = 
			"SELECT ID, author, dateComment, content, reported
			FROM comments
			WHERE article_ID = ?
			ORDER BY dateComment DESC";
		$result = $this->dataBase->createRequest($sql, [$articleID]);
		$comments = [];
		forEach($result as $row)
		{
			$commentID = $row["ID"];
			$comments[$commentID] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $comments;
	}

	public function addComment($author, $content, $article_ID)
	{
		$sql =
		"INSERT INTO comments (author, content, article_ID) 
		VALUES ('$author', '$content', '$article_ID')";
		$addComment = $this->dataBase->createRequest($sql);
		return $addComment;
	}

	public function reportComment($commentID)
	{
		$sql = 
			"UPDATE comments
			SET reported = 1
			WHERE ID = ?
			";
		$reportComment = $this->dataBase->createRequest($sql, [$commentID]);
	}
}