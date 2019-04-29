<?php 
namespace App\Src\Utility;

class DatesFRConvertor
{
	private static $dateFR;

	public static function convertDateToFR($date)
	{
		$dateWithOnlySpace = str_replace(array("-", ":"), " ", $date);
		list($year, $month, $day, $hour, $minute, $seconde) = explode(" ", $dateWithOnlySpace);
		$monthFR; $hourFR;

		switch ($month)
		{
			case "01":
			$monthFR = "Janvier";
			break;
			case "02":
			$monthFR = "Février";
			break;
			case "03":
			$monthFR = "Mars";
			break;
			case "04":
			$monthFR = "Avril";
			break;
			case "05":
			$monthFR = "Mai";
			break;
			case "06":
			$monthFR = "Juin";
			break;
			case "07":
			$monthFR = "Juillet";
			break;
			case "08":
			$monthFR = "Aout";
			break;
			case "09":
			$monthFR = "Septembre";
			break;
			case "10":
			$monthFR = "Octobre";
			break;
			case "11":
			$monthFR = "Novembre";
			break;
			case "12":
			$monthFR = "Décembre";
			break;
		}

		switch ($hour)
		{
			case "00":
			$hourFR = "minuit";
			break;
			case "01":
			$hourFR = $hour . " " . "heure";
			default:
			$hourFR = $hour . " " . "heures";
		}

		static::$dateFR = $day . " " . $monthFR . " " . $year . " - " . " A " . $hourFR . " " . $minute;
		return static::$dateFR;
	}

	public static function getSimplefiedDateConverted($date)
	{
		static::convertDateToFR($date);
		list($dateSimplified, $uselessPart) = explode("-", static::$dateFR);
		static::$dateFR = $dateSimplified;
		return static::$dateFR;
	}
}
