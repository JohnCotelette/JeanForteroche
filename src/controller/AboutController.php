<?php 
namespace App\Src\Controller;
use App\Src\Framework\Controller;

class AboutController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function showAbout()
	{
		$this->view->addCSS("about");
		$this->view->addTitle("Blog de Jean Forteroche - A propos");
		return $this->view->render("about", []);
	}
}