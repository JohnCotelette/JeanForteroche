<?php
namespace App\Src\Utility;

class ContentCutter
{
	private static $contentCut;

	public static function cutTheContentProperly($content)
	{
		$content = substr($content, 0, 400);
		$content = substr($content, 0, strrpos($content, " "));
		static::$contentCut = $content . " [...]";
		return static::$contentCut;
	}
}