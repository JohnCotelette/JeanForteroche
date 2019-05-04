<?php 
namespace App\Src\Controller;
use App\Src\framework\Database;
use App\Src\Model\ArticleModel;
use App\Src\Model\CommentModel;
use App\Src\Framework\View;
use App\Src\Utility\SpecialsDisplays;
use Exception;

class SingleArticleController
{
	private $articleModel;
	private $commentModel;
	private $view;

	public function __construct()
	{
		$database = new Database;
		$this->articleModel = new ArticleModel($database);
		$this->commentModel = new CommentModel($database);
		$this->view = new View();
	}

	public function article($articleID)
	{
		$article = $this->articleModel->getOneArticle($articleID);
		if ($article->getID() !== null)
		{
			$articles = $this->articleModel->getArticles();
			$totalArticles = count($articles);
			$comments = $this->commentModel->getCommentsArticle($articleID);
			$totalComments = count($comments);

			$title = htmlspecialchars($article->getTitleBook()) . " - " . htmlspecialchars($article->getTitle());

			$css1 = "singleArticle";
			if($_GET["articleID"] === "1" || $_GET["articleID"] == $totalArticles)
			{
				$css2 = SpecialsDisplays::arrowsNavDisplay($totalArticles);
				$css = [$css1, $css2];
			}
			else
			{
				$css = $css1;
			}
			if ($totalComments > 0)
			{
				$scripts = ["Captcha", "Ajax", "CommentsView", "PostAndReportComment"];
			}
			else
			{
				$scripts = ["Captcha", "Ajax", "PostAndReportComment"];
			}

			$this->view->addParameters($title, $css, $scripts);

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

	public function postComment($comment)
	{
		$author = urldecode($comment["name"]);
		$content = urldecode($comment["message"]);
		$article_ID = $comment["articleID"];
		var_dump($author, $content, $article_ID);
		$this->commentModel->addComment($author, $content, $article_ID);
	}

	public function reportComment($commentID)
	{
		$this->commentModel->reportComment($commentID);
	}
}