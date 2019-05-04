<?php 
namespace App\Src\Controller;
use App\Src\framework\Database;
use App\Src\Model\ArticleModel;
use App\Src\Framework\View;

class HomeController
{
	private $articleModel;
	private $view;

	public function __construct()
	{
		$database = new Database;
		$this->articleModel = new ArticleModel($database);
		$this->view = new View();
	}

	public function home()
	{
		$articles = $this->articleModel->getArticles();
		$totalArticles = count($articles);
		$lastArticle = $articles[$totalArticles];

		$this->view->addParameters("Blog de Jean Forteroche", "home", "PostsView");

		return $this->view->render("home", [
			"articles" => $articles,
			"lastArticle" => $lastArticle,
			"totalArticles" => $totalArticles
		]);
	}
}