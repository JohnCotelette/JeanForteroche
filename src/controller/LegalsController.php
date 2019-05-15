<?php 
namespace App\Src\Controller;
use App\Src\Framework\Controller;

class LegalsController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function showLegals()
	{
		$this->view->addCSS("legals");
		$this->view->addTitle("Blog de Jean Forteroche - Mentions légales");
		return $this->view->render("legals", []);
	}
}