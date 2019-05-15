<?php 
namespace App\Src\Framework;
use App\Src\Framework\Session;
use App\Src\Controller\HomeController;
use App\Src\Controller\SingleArticleController;
use App\Src\Controller\ErrorController;
use App\Src\Controller\AboutController;
use App\Src\Controller\ContactController;
use App\Src\Controller\LegalsController;
use App\Src\Controller\ConnectionController;
use App\Src\Controller\AdminController;
use Exception;

class Router 
{
	private $homeController;
	private $errorController;
	private $singleArticleController;
	private $aboutController;
	private $contactController;
	private $legalsController;
	private $signInController;
	private $adminController;

	public function __construct()
	{
		Session::buildSession();
		$this->homeController = new HomeController();
		$this->errorController = new ErrorController();
		$this->singleArticleController = new SingleArticleController();
		$this->aboutController = new AboutController();
		$this->contactController = new ContactController();
		$this->legalsController = new LegalsController();
		$this->connectionController = new ConnectionController();
		$this->adminController = new AdminController();
	}

	public function run()
	{
		try
		{
			if (!empty($_POST)) // For $_POSTS
			{
				if (isset($_POST["pseudo"]) && isset($_POST["password"]))
				{
					$this->connectionController->checkConnect($_POST);
				}
				else if (isset($_POST["autorisation"]) && $_POST["autorisation"] == "true")
				{
					$this->singleArticleController->postComment($_POST);
				}
				else if (isset($_POST["reported"]) && isset($_POST["commentID"]) && $_POST["reported"] == "true")
				{
					$this->singleArticleController->reportComment($_POST["commentID"]);
				}
				else if (isset($_SESSION["nameAdminBlog"]) && isset($_POST["cancelReport"]) && $_POST["cancelReport"] == "true")
				{
					$this->adminController->cancelReportComment($_POST["commentID"]);
				}
				else if (isset($_SESSION["nameAdminBlog"]) && isset($_POST["deleteComment"]) && $_POST["deleteComment"] == "true")
				{
					$this->adminController->deleteComment($_POST["commentID"]);
				}
				else if (isset($_SESSION["nameAdminBlog"]) && $_SESSION["rightsAdminBlog"] > 0 && isset($_POST["newBlogAdminName"]) && isset($_POST["newBlogAdminPassword"]) && isset($_POST["newBlogAdminStatut"]))
				{
					$this->adminController->addAdmin($_POST);
				}
				else if (isset($_SESSION["nameAdminBlog"]) && $_SESSION["rightsAdminBlog"] > 0 && isset($_POST["deleteAdmin"]) && $_POST["deleteAdmin"] == "true")
				{
					$this->adminController->deleteAdmin($_POST);
				}
				else if (isset($_SESSION["nameAdminBlog"]) && $_SESSION["rightsAdminBlog"] > 0 && isset($_POST["title"]) && isset($_POST["titleBook"]) && isset($_POST["articleContent"]) && isset($_FILES["picture"]))
				{
					$this->adminController->addArticle($_POST, $_FILES);
				}
				else if (isset($_SESSION["nameAdminBlog"]) && $_SESSION["rightsAdminBlog"] > 0 && isset($_POST["titleEdit"]) && isset($_POST["titleBookEdit"]) && isset($_POST["articleContentEdit"]) && isset($_FILES["pictureEdit"]))
				{
					$this->adminController->editArticle($_POST, $_FILES);
				}
				else if (isset($_SESSION["nameAdminBlog"]) && $_SESSION["rightsAdminBlog"] > 0 && isset($_POST["deleteArticle"]) && $_POST["deleteArticle"] == "true")
				{
					$this->adminController->deleteArticle($_POST["articleID"]);
				}
				else if (isset($_SESSION["nameAdminBlog"]) && $_SESSION["rightsAdminBlog"] > 0 && isset($_POST["requestDataArticle"]) && $_POST["requestDataArticle"] == "true")
				{
					$this->adminController->getDataArticle($_POST["articleID"]);
				}
			}
			else if (isset($_GET["route"])) // FOR $_GETS
			{
				if ($_GET["route"] === "singleArticle")
				{
					if (isset($_GET["articleID"]) && intval($_GET["articleID"])) 
					{
						$this->singleArticleController->article($_GET["articleID"]);
					} 
					else
					{
						throw new Exception;
					}
				}
				else if ($_GET["route"] === "about")
				{
					$this->aboutController->showAbout();
				}
				else if ($_GET["route"] === "contact")
				{
					$this->contactController->showContact();
				}
				else if ($_GET["route"] === "legals")
				{
					$this->legalsController->showLegals();
				}
				else if ($_GET["route"] === "signIn")
				{
					if (isset($_SESSION["nameAdminBlog"]))
					{
						header("Location: index.php?route=admin");
					}
					else
					{
						$this->connectionController->connect();
					}
				}
				else if ($_GET["route"] === "disconnect")
				{
					if (isset($_SESSION["nameAdminBlog"]))
					{
						$this->connectionController->disconnect();
					}
					else
					{
						throw new Exception;
					}
				}
				else if ($_GET["route"] === "admin")
				{
					if (isset($_SESSION["nameAdminBlog"]))
					{
						$this->adminController->showAdministratePage();
					}
					else
					{
						throw new Exception;
					}
				}
				else
				{
					throw new Exception;
				}
			} 
			else
			{
				$this->homeController->home();
			}
		}

		catch (Exception $e)
		{
			if (isset($_POST["pseudo"]) && isset($_POST["password"]))
			{
				$this->connectionController->connect($e);
			}
			else if ($_GET["route"] === "admin")
			{
				$this->errorController->notAuthorized();
			}
			else
			{
				$this->errorController->errorNotFound();
			}
		}
	}
}
