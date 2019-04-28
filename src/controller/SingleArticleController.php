<?php 
namespace App\Src\Controller;
use App\Src\Model\ArticleModel;
use App\Src\Model\CommentModel;
use App\Src\Framework\View;

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
		$comments = $this->commentModel->getCommentsArticle($articleID);
		return $this->view->render("singleArticle", [
			"article" => $article,
			"comments" => $comments
		]);
	}
}