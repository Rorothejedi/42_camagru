<?php
namespace App\model;

/**
 * Class App
 * Permet l'initialisation des constantes primaires de l'application (connexion à la base de données par exemple)
 */
class App
{
	/* -----------  For XAMPP  ---------*/
	const DB_NAME = 'instagru';
	const DB_USER = 'root';
	const DB_PASS = '';
	const DB_HOST = 'localhost';

	/*---------  For Custom MAMP -------*/
	// const DB_NAME = 'instagru';
 	// const DB_USER = 'root';
 	// const DB_PASS = 'rootpass';
	// const DB_HOST = 'mysql';

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
				self::DB_NAME,
				self::DB_USER,
				self::DB_PASS,
				self::DB_HOST);
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
