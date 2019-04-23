<?php 
require "../Config/dev.php";
require "../vendor/autoload.php";

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


