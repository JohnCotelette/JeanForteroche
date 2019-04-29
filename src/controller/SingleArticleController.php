<?php 
namespace App\Src\Controller;
use App\Src\Model\ArticleModel;
use App\Src\Model\CommentModel;
use App\Src\Framework\View;
use Exception;

class SingleArticleController
{
	private $articleModel;
	private $commentModel;
	private $view;

	public function __construct()
	{
		$this->articleModel = new ArticleModel();
		$this->commentModel = new CommentModel();
		$this->view = new View();
	}

	public function article($articleID)
	{
		$article = $this->articleModel->getOneArticle($articleID);
		if($article->getID() !== null)
		{
			$articles = $this->articleModel->getArticles();
			$totalArticles = count($articles);
			$comments = $this->commentModel->getCommentsArticle($articleID);
			$totalComments = count($comments);
			return $this->view->render("singleArticle", [
			"article" => $article,
			"totalArticles" => $totalArticles,
			"comments" => $comments,
			"totalComments" => $totalComments
			]);
		} 
		else 
		{
			throw new Exception("L'article demandé n'existe pas");
		}
	}
}