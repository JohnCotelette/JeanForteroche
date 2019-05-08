<?php 
namespace App\Src\Controller;
use App\Src\Framework\Database;
use App\Src\Framework\Controller;
use App\Src\Model\ArticleModel;
use App\Src\Model\CommentModel;
use App\Src\Utility\SpecialsDisplays;
use App\Src\Utility\FormattingHelper;
use Exception;

class SingleArticleController extends Controller
{
	private $articleModel;
	private $commentModel;

	public function __construct()
	{
		parent::__construct();
		$database = new Database;
		$this->articleModel = new ArticleModel($database);
		$this->commentModel = new CommentModel($database);
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
		$name = urldecode($comment["name"]);
		$surname = urldecode($comment["surname"]);
		$content = urldecode($comment["message"]);
		$article_ID = $comment["articleID"];
		$regexName = "/^[A-Za-z0-9]{3,16}$/";
		$realLengthContent = FormattingHelper::countOnlyCharacters($content);
		if (preg_match($regexName, $name) && preg_match($regexName, $surname) && $realLengthContent > 9 && $realLengthContent < 501)
		{
			$author = $surname . " " . $name;
			$content = addslashes($content);
			$this->commentModel->addComment($author, $content, $article_ID);
			echo "Ok";
		}
		else 
		{
			echo "Les champs 'Nom' et 'Prénom' doivent tous deux faire entre 3 et 16 caractères. Le commentaire doit faire entre 10 et 500 caractères.";
			return;
		}
	}

	public function reportComment($commentID)
	{
		$this->commentModel->reportComment($commentID);
	}
}