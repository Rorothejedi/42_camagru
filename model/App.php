<?php
namespace App\model;
require('./config/database.php');

define('DB_DSN', $DB_DSN);
define('DB_USER', $DB_USER);
define('DB_PASS', $DB_PASSWORD);

/**
 * Class App
 * Permet l'initialisation des constantes primaires de l'application (connexion à la base de données par exemple)
 */
class App
{
	const DOMAIN_NAME = '/camagru';
	private static $database;

	/**
	 * Permet d'établir la connexion à la base de données à l'aide de la classe Database.
	 * @return void Connexion à la base de données.
	 */
	public static function getDb()
	{
		if (self::$database === null)
		{
			self::$database = new Database(
				DB_DSN,
				DB_USER,
				DB_PASS);
		}
		return self::$database;
	}

	/**
	 * Permet d'avoir accès depuis tout le site au chemin absolue.
	 * @return string Chemin d'accès par défaut du site.
	 */
	public static function getDomainPath()
	{
		return self::DOMAIN_NAME;
	}
}
