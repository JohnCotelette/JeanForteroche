<?php 
namespace App\Src\Controller;
use App\Src\Framework\Controller;

class ContactController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function showContact()
	{
		$this->view->addCSS("contact");
		$this->view->addTitle("Blog de Jean Forteroche - Contact");
		return $this->view->render("contact", []);
	}
}