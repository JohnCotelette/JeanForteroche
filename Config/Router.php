<?php 

namespace App\Config;

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
					require "../Templates/single.php";
				} 
				else
				{
					echo "Page Inconnue !";
				}
			} 
			else
			{
				require "../Templates/home.php";
			}
		}

		catch(Exception $e)
		{
			echo "Erreur, le paramètre n'existe pas !";
		}
	}
}
