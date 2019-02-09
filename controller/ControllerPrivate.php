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
	 * Méthode d'affichage de la page de montage photo (studio).
	 */
	public function displayStudio()
	{
		require('./view/viewPrivate/viewStudio.php');
	}

	/**
	 * Méthode d'affichage de la page de gestion des paramètres et des préférences.
	 */
	public function displaySettings()
	{
		$userData = $this->callUserData();
		require('./view/viewPrivate/viewSettings.php');
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

	/**
	 * Instancie l'objet User avec les données de l'utilisateur en cours.
	 * @return Object User
	 */
	private function initUser()
	{
		$user = new \App\model\User([
			'id'       => $_SESSION['user_id'], 
			'username' => $_SESSION['user_username']
		]);
		return $user;
	}

	/**
	 * Permet la récupération des données concernant l'utilisateur actuellement connecté.
	 * @return array Tableau contenant les données de l'utilisateur connecté.
	 */
	private function callUserData()
	{
		$user = $this->initUser();
		$userManager = new \App\model\UserManager();
		$userData    = $userManager->getUser($user);
		return $userData;
	}


}