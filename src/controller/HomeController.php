<?php 
namespace App\Src\Controller;
use App\Src\Model\ArticleModel;
use App\Src\Model\CommentModel;
use App\Src\Framework\View;

class HomeController
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

	public function home()
	{
		$articles = $this->articleModel->getArticles();
		return $this->view->render("home", [
			"articles" => $articles // C'est ici qu'on selectionnera le dernier article avec getLastArticle() par exemple.
		]);
	}

	public function article($articleID)
	{
		$article = $this->articleModel->getOneArticle($articleID);
		$comments = $this->commentModel->getCommentsArticle($articleID);
		return $this->view->render("single", [
			"article" => $article,
			"comments" => $comments
		]);
	}
}