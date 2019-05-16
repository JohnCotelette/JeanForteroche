<?php 
namespace App\Src\Controller;
use App\Src\Framework\Database;
use App\Src\Framework\Controller;
use App\Src\Model\ArticleModel;

class HomeController extends Controller
{
	private $articleModel;

	public function __construct()
	{
		parent::__construct();
		$database = new Database;
		$this->articleModel = new ArticleModel($database);
	}

	public function home()
	{
		$articles = $this->articleModel->getArticles();
		$totalArticles = count($articles);
		$lastArticle = reset($articles);
		$this->view->addParameters("Blog de Jean Forteroche - Projet 4 Openclassrooms.", "home", "PostsView");
		return $this->view->render("home", [
			"articles" => $articles,
			"lastArticle" => $lastArticle,
			"totalArticles" => $totalArticles
		]);
	}
}