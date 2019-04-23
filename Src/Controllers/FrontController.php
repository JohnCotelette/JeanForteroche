<?php 
namespace App\Src\Controllers;
use App\Src\Managers\ArticleManager;
use App\Src\Managers\CommentManager;


class FrontController 
{
	public function home()
	{
		$article = new ArticleManager;
		$articles = $article->getArticles();

		require "../Templates/home.php";
	}

	public function article($articleID)
	{
		$article = new ArticleManager;
		$articles = $article->getOneArticle($articleID);
		$comment = new CommentManager;
		$comments = $comment->getCommentsArticle($articleID);

		require "../Templates/single.php";
	}
}