<?php 
namespace App\Src\Controller;
use App\Src\Framework\View;

class ErrorController
{
	private $view;

	public function __construct()
	{
		$this->view = new View();
	}

	public function errorNotFound()
	{
		$this->view->addTitle("Erreur, page non trouvée...");
		$this->view->addCss("404NotFound");
		return $this->view->render("404NotFound", []);
	}
}