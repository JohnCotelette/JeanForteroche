<?php 

class DataBase
{
	const DB_HOST = "mysql:host=localhost;dbname=blog;charset=utf8";
	const DB_USER = "root";
	const DB_PASSWORD = "";

	public function getConnection()
	{
		try
		{
			$dbConnect = new PDO(self::DB_HOST, self::DB_USER, self::DB_PASSWORD);
			$dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $dbConnect;
		}

		catch(Exception $errorConnect)
		{
			"Erreur: " . $errorConnect->getMessage();
		}
	}
}