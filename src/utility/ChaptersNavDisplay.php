<?php
namespace App\Src\Utility;

class ChaptersNavDisplay
{
	private static $index;

	public static function display($totalArticles)
	{
		static::$index = $_GET["articleID"];
		if (static::$index == 1)
		{
			return '<link rel="stylesheet" href="css/chaptersNavButton1.css" />';
		}
		else if (static::$index == $totalArticles)
		{
			return '<link rel="stylesheet" href="css/chaptersNavButton2.css" />';
		}
	}
}