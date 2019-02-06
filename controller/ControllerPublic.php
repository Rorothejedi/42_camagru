<?php 
namespace App\controller;

/**
 * Controller qui gère les views et les models de la partie public du site (page d'accueil (galerie), de connexion, d'inscription et les mentions légales).
 */

class ControllerPublic
{
	/**
	 * Méthode d'affichage de la page d'accueil (galerie).
	 */
	public function displayGallery()
	{
		require('./view/viewPublic/viewGallery.php');
	}

	/**
	 * Méthode d'affichage de la page d'inscription.
	 */
	public function displayRegister()
	{
		require('./view/viewPublic/viewRegister.php');
	}

	/**
	 * Méthode d'affichage de la page de connexion.
	 */
	public function displayConnection()
	{
		require('./view/viewPublic/viewConnection.php');
	}
}