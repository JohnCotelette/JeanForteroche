<?php
namespace App\Src\Model;
use App\Src\Framework\Model;
use App\Src\Entity\Admin;


class AdminModel extends Model
{
	private function buildObject($row)
	{
		$admin = new Admin;
		$admin->setID($row["ID"]);
		$admin->setName($row["name"]);
		$admin->setPassword($row["password"]);
		return $admin;
	}

	public function addAdmin($name, $password, $rights)
	{
		$sql=
			"INSERT INTO admin (name, password, rights)
			VALUES (?, ?, ?)";
		$addAdmin = $this->dataBase->createRequest($sql, [$name, $password, $rights]);
	}

	public function checkAdminIfExist($nameAdmin)
	{
		$sql =
			"SELECT ID, name, password 
			FROM admin
			WHERE name = ?";
		$result = $this->dataBase->createRequest($sql, [$nameAdmin]);
		$admin = $result->fetch();
		$result->closeCursor();
		if ($admin)
		{
			return $this->buildObject($admin);
		}
		else
		{
			throw new Exception;
		}
	}
}
