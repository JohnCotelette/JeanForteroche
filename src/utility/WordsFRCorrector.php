<?php
namespace App\Src\Utility;

class WordsFRCorrector
{
	private static $word;

	public static function singularOrPluralCorrector($word, $number)
	{
		if($number < 2)
		{
			static::$word = substr($word, 0, -1);
			return static::$word;
		}
		else
		{
			static::$word = $word;
			return static::$word; 
		}
	}
}