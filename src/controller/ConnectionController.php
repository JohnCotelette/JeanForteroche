<?php
namespace App\Src\Controller;
use App\Src\Framework\Database;
use App\Src\Framework\Controller;
use App\Src\Framework\Session;
use App\Src\Model\AdminModel;
use App\Src\Entity\Admin;
use Exception;

class ConnectionController extends Controller
{
	private $adminModel;

	public function __construct()
	{
		parent::__construct();
		$database = new Database;
		$this->adminModel = new AdminModel($database);
	}

	public function connect($failConnect = null)
	{
		if ($failConnect)
		{
			$this->view->addParameters("Connexion", ["signIn", "failConnect"], ["Captcha", "NotARobot"]);
		}
		else
		{
			$this->view->addParameters("Connexion", "signIn", ["Captcha", "NotARobot"]);
		}
		return $this->view->render("signIn", []);
	}

	public function disconnect()
	{
		Session::endSession();
		$this->view->addTitle("Déconnexion...");
		$this->view->addCss("disconnect");
		return $this->view->render("disconnect", []);
	}

	public function checkConnect($data)
	{
		$name = $data["pseudo"];
		$password = $data["password"];

		try
		{
			$admin = $this->adminModel->checkAdminIfExist($name);
			if (password_verify($password, $admin->getPassword()))
				{
					$rights = $admin->getRights();
					Session::customizeSession("nameAdminBlog", $name);
					Session::customizeSession("rightsAdminBlog", $rights);
					header("Location: index.php?route=admin");
				}
				else
				{
					throw new Exception;
				}
		}

		catch (Exception $e)
		{
			throw new Exception;
		}
	}
}