<?php 
namespace App\Src\Controller;
use App\Src\Framework\View;

class AboutController
{
	private $view;

	public function __construct()
	{
		$this->view = new View();
	}

	public function about()
	{
		$this->view->addCSS("about");
		$this->view->addTitle("Blog de Jean Forteroche - A propos");
		return $this->view->render("about", []);
	}
}