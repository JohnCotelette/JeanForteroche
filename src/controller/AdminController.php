<?php 
namespace App\Src\Controller;
use App\Src\Framework\Database;
use App\Src\Framework\Controller;
use App\Src\Model\AdminModel;

class AdminController extends Controller
{
	private $adminModel;

	public function __construct()
	{
		parent::__construct();
		$database = new Database;
		$this->adminModel = new AdminModel($database);
	}

	public function addAdmin($name, $password, $rights)
	{
		if($rights === "full")
		{
			$rights = 1;
		}
		else
		{
			$rights = 0;
		}
		$password = password_hash($password, PASSWORD_DEFAULT);
		$this->adminModel->addAdmin($name, $password, $rights);
	}
}