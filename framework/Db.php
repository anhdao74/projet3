<?php

class Db
{
	public static function getConnexionPDO()
	{
		$db = new PDO('mysql:host=localhost;dbname=projet3;charset=utf8', 'root', '');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $db;
	}
}