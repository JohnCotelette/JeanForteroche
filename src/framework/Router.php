<?php 
namespace App\Src\Framework;
use App\Src\Framework\Session;
use App\Src\Controller\HomeController;
use App\Src\Controller\SingleArticleController;
use App\Src\Controller\ErrorController;
use App\Src\Controller\AboutController;
use App\Src\Controller\SignInController;
use App\Src\Controller\AdminController;
use Exception;

class Router 
{
	private $homeController;
	private $errorController;
	private $singleArticleController;
	private $aboutController;
	private $signInController;
	private $adminController;

	public function __construct()
	{
		Session::buildSession();
		$this->homeController = new HomeController();
		$this->errorController = new ErrorController();
		$this->singleArticleController = new SingleArticleController();
		$this->aboutController = new AboutController();
		$this->signInController = new SignInController();
		$this->adminController = new AdminController();
	}

	public function run()
	{
		try
		{
			if (!empty($_POST))
			{
				if (isset($_POST["pseudo"]) && isset($_POST["password"]))
				{
					$this->signInController->checkConnect($_POST);
				}
				else if (isset($_POST["autorisation"]) && $_POST["autorisation"] == "true")
				{
					$this->singleArticleController->postComment($_POST);
				}
				else if (isset($_POST["reported"]) && isset($_POST["commentID"]) && $_POST["reported"] == "true")
				{
					$this->singleArticleController->reportComment($_POST["commentID"]);
				}
			}
			else if (isset($_GET["route"]) || isset($_GET["about"]) || isset($_GET["signIn"]) || isset($_GET["admin"]))
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
					$this->aboutController->about();
				}
				else if ($_GET["route"] === "signIn")
				{
					$this->signInController->connect();
				}
				else if ($_GET["route"] === "admin")
				{
					if (isset($_SESSION["name"]))
					{
						echo "salut l'admin !";
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
				$this->signInController->connect($e);
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
