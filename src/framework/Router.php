<?php 
namespace App\Src\Framework;
use App\Src\Controller\HomeController;
use App\Src\Controller\SingleArticleController;
use App\Src\Controller\ErrorController;
use Exception;

class Router 
{
	private $homeController;
	private $errorController;

	public function __construct()
	{
		$this->homeController = new HomeController();
		$this->errorController = new ErrorController();
		$this->singleArticleController = new SingleArticleController();
	}

	public function run()
	{
		try
		{
			if(isset($_GET["route"]))
			{
				if($_GET["route"] === "singleArticle" && (isset($_GET["articleID"])) && intval($_GET["articleID"])) 
				{
					$this->singleArticleController->article($_GET["articleID"]);
				} 
				else
				{
					$this->errorController->errorNotFound();
				}
			} 
			else
			{
				$this->homeController->home();
			}
		}

		catch(Exception $e)
		{
			$this->errorController->errorServer();
			echo $e->getMessage();
		}
	}
}
