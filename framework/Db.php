<?php

class Db
{
	public static function getConnexionPDO()
	{
		$db = new PDO('mysql:host=db723801243.db.1and1.com;dbname=db723801243;charset=utf8', 'dbo723801243', 'Chipiebebe8!');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $db;
	}
}