<?php
namespace App\Src\Utility;

class SpecialsDisplays
{
	static public function arrowsNavDisplay($totalArticles)
	{
		$index = $_GET["articleID"];
		if ($index == 1)
		{
			return "chaptersNavButton1";
		}
		else if ($index == $totalArticles)
		{
			return "chaptersNavButton2";
		}
		else
		{
			return;
		}
	}
}