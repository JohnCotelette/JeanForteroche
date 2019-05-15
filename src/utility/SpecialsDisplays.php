<?php
namespace App\Src\Utility;

class SpecialsDisplays
{
	static public function articlesNavigator($currentID, $array, $parameter) 
	{
		forEach($array as $value)
		{
			if ($value == $currentID)
			{
				break;
			}
			else
			{
				next($array);
			}
		}

		if ($parameter === "left")
		{
			$previousID = prev($array);
			if (!$previousID)
			{
				$previousID = end($array);
			}
			return $previousID;
		}
		else 
		{
			$nextID = next($array);
			if (!$nextID)
			{
				$nextID = reset($array);
			}
			return $nextID;
		}
	}

	static public function arrowsNavDisplay($array)
	{
		$index = $_GET["articleID"];
		if ($index == reset($array))
		{
			return "chaptersNavButton1";
		}
		else if ($index == end($array))
		{
			return "chaptersNavButton2";
		}
		else
		{
			return;
		}
	}
}