<?php
namespace App\Src\Controller;
use App\Src\framework\Database;
use App\Src\Framework\View;

class SignInController
{
	private $view;

	public function __construct()
	{
		$database = new Database;
		$this->view = new View();
	}

	public function connect()
	{
		
	}
}