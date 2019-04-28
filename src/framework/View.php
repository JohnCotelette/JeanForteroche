<?php 
namespace App\Src\Framework;

class View
{
	private $file;
	private $title;
	private $scripts;

	public function render($template, $data = [])
	{
		$this->file = "../template/" . $template . ".php";
		$content = $this->renderFile($this->file, $data);
		$view = $this->renderFile("../template/base.php", [
			"title" => $this->title,
			"content" => $content,
			"scripts" =>$this->scripts
		]);
		echo $view;
	}

	public function renderFile($file, $data)
	{
		if(file_exists($file))
		{
			extract($data);
			ob_start();
			require $file;
			return ob_get_clean();
		}
		else
		{
			header("Location: index.php?route=notFound");
		}
	}
}