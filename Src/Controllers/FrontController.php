<?php 
namespace App\Src\Controllers;
use App\Src\Managers\ArticleManager;
use App\Src\Managers\CommentManager;


class FrontController 
{
	private $articleManager;
	private $commentManager;

	public function __construct()
	{
		$this->articleManager = new ArticleManager();
		$this->commentManager = new CommentManager();
	}

	public function home()
	{
		$articles = $this->articleManager->getArticles();
		require "../Templates/home.php";
	}

	public function article($articleID)
	{
		$article = $this->articleManager->getOneArticle($articleID);
		$comments = $this->commentManager->getCommentsArticle($articleID);

		require "../Templates/single.php";
	}
}