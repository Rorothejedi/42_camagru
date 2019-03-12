<?php
//Pour utiliser ce fichier, décommentez la ligne '/setup' dans index.php
namespace App\config;
require('./config/database.php');
use PDO;

if (!isset($_SERVER['PHP_AUTH_USER']) 
	|| $_SERVER['PHP_AUTH_USER'] != 'rcabotia'
	|| $_SERVER['PHP_AUTH_PW'] != 'setup')
{
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo '<p>ACCESS DENIED</p>';
    exit;
}
else
{
	try
	{
		$pdo = new \PDO($DB_DSN_S, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->query("
			DROP DATABASE IF EXISTS " . $DB_NAME . ";
			CREATE DATABASE IF NOT EXISTS " . $DB_NAME . ";
			USE " . $DB_NAME . ";
			SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
			SET AUTOCOMMIT = 0;
			START TRANSACTION;
			SET time_zone = '+00:00';

			CREATE TABLE `user` (
			 `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
			 `username` varchar(30) NOT NULL,
			 `email` varchar(255) NOT NULL,
			 `password` varchar(255) NOT NULL,
			 `token` varchar(255) NULL,
			 `confirm` tinyint(1) NOT NULL DEFAULT '0',
			 `prefTheme` tinyint(1) NOT NULL DEFAULT '1',
			 `prefComment` tinyint(1) NOT NULL DEFAULT '1',
			 `prefLike` tinyint(1) NOT NULL DEFAULT '0'
			);
			CREATE TABLE `image` (
			 `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
			 `id_user` int(11) NOT NULL,
			 `name` varchar(255) NOT NULL,
			 `date` datetime NOT NULL
			);
			CREATE TABLE `like` (
			 `id_user` int(11) NOT NULL,
			 `id_image` int(11) NOT NULL
			);
			CREATE TABLE `comment` (
			 `id_user` int(11) NOT NULL,
			 `id_image` int(11) NOT NULL,
			 `content` text NOT NULL,
			 `date` datetime NOT NULL
			);

			ALTER TABLE `image`
			  ADD KEY `FK_id_user` (`id_user`);
			ALTER TABLE `like`
			  ADD KEY `FK_id_user` (`id_user`),
			  ADD KEY `FK_id_image` (`id_image`);
			ALTER TABLE `comment`
			  ADD KEY `FK_id_user` (`id_user`),
			  ADD KEY `FK_id_image` (`id_image`);

			ALTER TABLE `image`
			  ADD CONSTRAINT `FK_id_user_image` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;
			ALTER TABLE `like`
			  ADD CONSTRAINT `FK_id_user_like` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
			  ADD CONSTRAINT `FK_id_image_like` FOREIGN KEY (`id_image`) REFERENCES `image` (`id`) ON DELETE CASCADE;
			ALTER TABLE `comment`
			  ADD CONSTRAINT `FK_id_user_comment` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
			  ADD CONSTRAINT `FK_id_image_comment` FOREIGN KEY (`id_image`) REFERENCES `image` (`id`) ON DELETE CASCADE;");
		if (isset($_COOKIE['auth']))
			setcookie('auth', '', time() - 3600, null, null, false, true);
		if (isset($_SESSION['user_id']) && isset($_SESSION['user_username']))
			session_destroy();
		echo 'La base de données ' . strtoupper($DB_NAME) .' a été créé avec succès !';
	}
	catch (Exception $error)
	{
		echo $error;
	}
}