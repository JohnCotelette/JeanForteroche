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
			$articlesID = [];
			forEach($articles as $oneArticle)
			{
				array_unshift($articlesID, $oneArticle->getID());
			}
			$comments = $this->commentModel->getCommentsArticle($articleID);
			$totalComments = count($comments);
			$title = htmlspecialchars($article->getTitleBook()) . " - " . htmlspecialchars($article->getTitle());
			$css = ["singleArticle"];
			$articlesList = $articlesID;
			if($_GET["articleID"] == reset($articlesList) || $_GET["articleID"] == end($articlesList))
			{
				$css2 = SpecialsDisplays::arrowsNavDisplay($articlesID);
				$css[] = $css2;
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
			"articlesID" => $articlesID,
			"article" => $article,
			"totalArticles" => $totalArticles,
			"comments" => $comments,
			"totalComments" => $totalComments
			]);
		} 
		else 
		{
			throw new Exception;
		}
	}

	public function postComment($comment)
	{
		try
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
				throw new Exception("Les champs 'Nom' et 'Prénom' doivent tous deux faire entre 3 et 16 caractères. Le commentaire doit faire entre 10 et 500 caractères.");
			}
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function reportComment($commentID)
	{
		$this->commentModel->reportComment($commentID);
	}
}