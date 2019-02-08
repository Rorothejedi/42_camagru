<?php 
namespace App\controller;

/**
 * Class ControllerPrivate
 * Controller qui gère les views et les models de la partie privé du site (Profil utilisateurs, deconnexion, studio). 
 */
class ControllerPrivate extends Alert
{
	/**
	 * Vérification de l'existence d'un session de l'utilisateur pour autoriser l'accès à la partie privée.
	 */
	public function __construct()
	{
		if (empty($_SESSION['user_id']) && empty($_SESSION['user_username'])) 
		{ 
			header('Location: ./connexion');
			exit;
		}
	}

	/**
	 * Permet de déconnecter un utilisateur de la session en cours.
	 * Supprime la session en cours ainsi que le cookie de session.
	 */
	public function disconnect()
	{
		session_destroy();
		setcookie('auth', '', time() - 3600, null, null, false, true);
		header('Location: ./');
		exit;
	}


}