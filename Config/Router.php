<?php 
namespace App\Config;
use App\Src\Controllers\FrontController;
use Exception;


class Router 
{
	private $frontController;

	public function __construct()
	{
		$this->frontController = new FrontController();
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
					echo "Page Inconnue !";
				}
			} 
			else
			{
				$this->frontController->home();
			}
		}

		catch(Exception $e)
		{
			echo "Erreur, le paramètre n'existe pas !";
		}
	}
}
