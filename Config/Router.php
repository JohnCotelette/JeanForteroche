<?php 
namespace App\Config;
use App\Src\Controllers\FrontController;
use Exception;


class Router 
{
	public function run()
	{
		try
		{
			if(isset($_GET["route"]))
			{
				if($_GET["route"] === "article") 
				{
					$frontController = new FrontController();
					$frontController->article($_GET["articleID"]);
				} 
				else
				{
					echo "Page Inconnue !";
				}
			} 
			else
			{
				$frontController = new FrontController();
				$frontController->home();
			}
		}

		catch(Exception $e)
		{
			echo "Erreur, le paramètre n'existe pas !";
		}
	}
}
