<?php
namespace App\Src\Model;
use App\Src\Framework\Database;

class Model
{
	public $dataBase;

	public function __construct(Database $item)
	{
		$this->dataBase = $item;
	}
}