<?php 
namespace App\Src\Controller;
use App\Src\Framework\Database;
use App\Src\Framework\Controller;
use App\Src\Model\AdminModel;
use App\Src\Model\ArticleModel;
use App\Src\Model\CommentModel;
use App\Src\Utility\FormattingHelper;
use Exception;

class AdminController extends Controller
{
	private $adminModel;
	private $articleModel;
	private $commentModel;

	public function __construct()
	{
		parent::__construct();
		$database = new Database;
		$this->adminModel = new AdminModel($database);
		$this->articleModel = new ArticleModel($database);
		$this->commentModel = new CommentModel($database);
	}

	public function showAdministratePage()
	{
		$articles = $this->articleModel->getArticles();
		$totalArticles = count($articles);
		$reportedComments = $this->commentModel->getReportedComments();
		$totalReportedComments = count($reportedComments);
		$adminsList = $this->adminModel->getAdminsList();
		$totalAdmins = count($adminsList);
		$title = "Administration - " . $_SESSION["nameAdminBlog"];
		$this->view->addParameters($title, "admin", ["tinymce/tinymce", "tinyLauncher", "Ajax", "InterfaceAdmin"]);
		return $this->view->render("administrate", [
			"articles" => $articles,
			"totalArticles" => $totalArticles,
			"reportedComments" => $reportedComments,
			"totalReportedComments" => $totalReportedComments,
			"adminsList" => $adminsList,
			"totalAdmins" => $totalAdmins
		]);
	}

	public function addArticle($data, $file)
	{
		try
		{
			$newArticleTitle = $data["title"];
			$newArticleTitleBook = $data["titleBook"];
			$newArticleContent = $data["articleContent"];
			$newArticleAuthor = $_SESSION["nameAdminBlog"];
			$newArticlePicture = $file["picture"];
			if (FormattingHelper::countOnlyCharacters($newArticleTitle) > 3 && FormattingHelper::countOnlyCharacters($newArticleTitleBook) > 3 && FormattingHelper::countOnlyCharacters($newArticleContent) > 5)
			{
				$newArticleTitle = addslashes($newArticleTitle);
				$newArticleTitleBook = addslashes($newArticleTitleBook);
				$newArticleContent = addslashes($newArticleContent);
			}
			else
			{
				throw new Exception("Veuillez saisir un minimum de contenu pour les différents champs (3 caractères au minimum pour les titres et 5 pour le contenu.");
			}
			if ($newArticlePicture["size"] > 0 && $newArticlePicture["size"] < 307200)
			{
				if ($newArticlePicture["type"] === "image/jpg" || $newArticlePicture["type"] === "image/jpeg")
				{
					$directory = "img/";
					$locationPicture = $newArticlePicture["tmp_name"];
					$namePicture = $newArticlePicture["name"];
					if (file_exists("$directory/$namePicture"))
					{
						$namePicture = time() . $namePicture;
					}
					move_uploaded_file($locationPicture, "$directory/$namePicture");
					$namePictureForDB = FormattingHelper::cutExtension($namePicture);
					$this->articleModel->addArticle($newArticleTitle, $newArticleTitleBook, $newArticleAuthor, $newArticleContent, $namePictureForDB);
					echo "L'article a bien été ajouté.";
				}
				else
				{
					throw new Exception("L'image doit être au format jpg/jpeg.");
				}
			}
			else
			{
				throw new Exception("L'image doit peser moinds de 300 kio.");
			}
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function editArticle($data, $file)
	{
		try
		{
			$articleIDEdit = $data["articleID"];
			$articleTitleEdit = $data["titleEdit"];
			$articleTitleBookEdit = $data["titleBookEdit"];
			$articleContentEdit = $data["articleContentEdit"];
			$articleAuthorEdit = null;
			$namePictureForDB = null;
			if ($data["firstAuthor"] !== $_SESSION["nameAdminBlog"])
			{
				$articleAuthorEdit = $_SESSION["nameAdminBlog"];
			}
			if (FormattingHelper::countOnlyCharacters($articleTitleEdit) > 3 && FormattingHelper::countOnlyCharacters($articleTitleBookEdit) > 3 && FormattingHelper::countOnlyCharacters($articleContentEdit) > 5)
			{
				$articleTitleEdit = addslashes($articleTitleEdit);
				$articleTitleBookEdit = addslashes($articleTitleBookEdit);
				$articleContentEdit = addslashes($articleContentEdit);
			}
			else
			{
				throw new Exception("Veuillez saisir un minimum de contenu pour les différents champs (3 caractères au minimum pour les titres et 5 pour le contenu.");
			}
			if ($file["pictureEdit"]["size"] !== 0)
			{
				if ($file["pictureEdit"]["size"] < 307200)
				{
					if ($file["pictureEdit"]["type"] === "image/jpg" || $file["pictureEdit"]["type"] === "image/jpeg")
					{
						$articlePictureEdit = $file["pictureEdit"];
						$lastPictureName = $data["lastPictureName"];
						$directory = "img/";
						$locationPicture = $articlePictureEdit["tmp_name"];
						$namePicture = $articlePictureEdit["name"];
						if (file_exists("$directory/$namePicture"))
						{
							$namePictureForDB = time() . $namePicture;
						}
						move_uploaded_file($locationPicture, "$directory/$namePicture");
						$namePictureForDB = FormattingHelper::cutExtension($namePicture);
						$oldPictureLocation = $directory . $lastPictureName . ".jpg";
						if (!file_exists("$oldPictureLocation"))
						{
							$oldPictureLocation = $directory . $lastPictureName . ".jpeg";
							if (!file_exists("$oldPictureLocation"))
							{
								$oldPictureLocation = $directory . $lastPictureName;
							}
						}
						unlink("$oldPictureLocation");
					}
					else
					{
						throw new Exception("L'image doit être au format jpg/jpeg.");
					}
				}
				else
				{
					throw new Exception("L'image doit peser moinds de 300 kio.");
				}
			}
			$this->articleModel->updateArticle($articleIDEdit, $articleTitleEdit, $articleTitleBookEdit, $articleContentEdit, $articleAuthorEdit, $namePictureForDB);
			echo "L'article a bien été modifié.";
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function deleteArticle($articleID)
	{
		$article = $this->articleModel->getOneArticle($articleID);
		$this->articleModel->deleteArticle($articleID);
		$pictureName = $article->getImageLink();
		$directory = "img/";
		$pictureLocation = $directory . $pictureName . ".jpg";
		if (!file_exists("$pictureLocation"))
		{
			$pictureLocation = $directory . $pictureName . ".jpeg";
			if (!file_exists("$pictureLocation"))
			{
				$pictureLocation = $directory . $pictureName;
			}
		}
		unlink("$pictureLocation");
	}

	public function getDataArticle($articleID)
	{
		$articleData = $this->articleModel->getOneArticle($articleID, true);
		echo $articleData;
	}

	public function cancelReportComment($commentID)
	{
		$this->commentModel->cancelReport($commentID);
	}

	public function deleteComment($commentID)
	{
		$this->commentModel->deleteComment($commentID);
	}

	public function addAdmin($data)
	{
		try
		{
			$name = urldecode($data["newBlogAdminName"]);
			$password = urldecode($data["newBlogAdminPassword"]);
			$regexAdmin = "/^[[:alnum:][:punct:]]{8,25}$/";
			if (preg_match($regexAdmin, $name) && preg_match($regexAdmin, $password))
			{
				$name = addslashes($name);
				$password = addslashes($password);
				$password = password_hash($password, PASSWORD_DEFAULT);
				$rights;
				switch($data["newBlogAdminStatut"])
				{
					case "modérateur":
						$rights = 0;
						break;
					case "administrateur":
						$rights = 1;
						break;
				}
				$this->adminModel->addAdmin($name, $password, $rights);
				echo "Le nouveau collaborateur a bien été ajouté à la base de données.";
			}
			else
			{
				throw new Exception("Le pseudo et le mot de passe saisis sont tous deux soumis à un minimum de 8 caractères et 25 au maximum.");
			}
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function deleteAdmin($data)
	{
		try
		{
			if ($data["adminID"] > 1)
			{
				$this->adminModel->deleteAdmin($data["adminID"]);
				echo "L'admin séléctionné a bien été supprimé de la base de données.";
			}
			else
			{
				throw new Exception ("Le propriétaire du site est la seule personne a ne pas pouvoir être supprimée de la base de données.");
			}
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
}