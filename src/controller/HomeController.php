<?php 
namespace App\Src\Controller;
use App\Src\Model\ArticleModel;
use App\Src\Framework\View;

class HomeController
{
	private $articleModel;
	private $view;

	public function __construct()
	{
		$this->articleModel = new ArticleModel();
		$this->view = new View();
	}

	public function home()
	{
		$articles = $this->articleModel->getArticles();
		$totalArticles = count($articles);
		$lastArticle = $articles[$totalArticles];
		return $this->view->render("home", [
			"articles" => $articles,
			"lastArticle" => $lastArticle,
			"totalArticles" => $totalArticles
		]);
	}
}