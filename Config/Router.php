<?php 
namespace App\Config;
use App\Src\Controllers\FrontController;
use App\Src\Controllers\BackController;
use App\Src\Controllers\ErrorController;
use Exception;


class Router 
{
	private $frontController;
	private $backController;
	private $errorController;

	public function __construct()
	{
		$this->frontController = new FrontController();
		$this->backController = new BackController();
		$this->errorController = new ErrorController();
	}

	public function run()
	{
		try
		{
			if(isset($_GET["route"]))
			{
				if($_GET["route"] === "article") 
				{
					$this->frontController->article($_GET["articleID"]);
				} 
				else
				{
					$this->errorController->errorNotFound();
				}
			} 
			else
			{
				$this->frontController->home();
			}
		}

		catch(Exception $e)
		{
			$this->errorController->errorServer();
		}
	}
}
