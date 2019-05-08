<?php 
namespace App\Src\Controller;
use App\Src\Framework\Controller;

class ErrorController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function errorNotFound()
	{
		$this->view->addTitle("Erreur, page non trouvée...");
		$this->view->addCss("error");
		return $this->view->render("404NotFound", []);
	}

	public function notAuthorized()
	{
		$this->view->addTitle("Erreur, accès non autorisé...");
		$this->view->addCss("error");
		return $this->view->render("notAuthorized", []);
	}
}