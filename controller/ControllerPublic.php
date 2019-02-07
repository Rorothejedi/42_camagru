<?php
namespace App\controller;

/**
 * Controller qui gère les views et les models de la partie public du site (page d'accueil (galerie), de connexion, d'inscription et les mentions légales).
 */

class ControllerPublic extends Alert
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
	 * Méthode d'affichage de la page de confirmation de l'inscription.
	 */
	public function displayRegisterConfirm()
	{
		require('./view/viewPublic/viewRegisterConfirm.php');
	}

	/**
	 * Méthode d'affichage de la page de connexion.
	 */
	public function displayConnection()
	{
		require('./view/viewPublic/viewConnection.php');
	}

	/**
	 * Méthode d'affichage de la page des mentions légales.
	 */
	public function displayLegal()
	{
		require('./view/viewPublic/viewLegal.php');
	}

	/**
	 * Permet la gestion des données d'inscription (récupération, traitement, transformation) avec une gestion des erreurs
	 * Une fois les données traitées, elles sont enregistrées dans la base de données. Un mail est envoyé à l'adresse mail indiquée et l'utilisateur et redirigé vers la page de confirmation de l'inscription.
	 */
	public function processRegistration()
	{
		if (isset($_POST['username']) && !empty($_POST['username'])
			&& isset($_POST['email']) && !empty($_POST['email'])
			&& isset($_POST['pass']) && !empty($_POST['pass'])
			&& isset($_POST['passconfirm']) && !empty($_POST['passconfirm']))
		{
			$username    = htmlspecialchars($_POST['username']);
			$email       = htmlspecialchars($_POST['email']);
			$pass        = htmlspecialchars($_POST['pass']);
			$passconfirm = htmlspecialchars($_POST['passconfirm']);
			if (isset($_POST['consent']) && !empty($_POST['consent']))
			{
				if (strlen($username) >= 2 && strlen($username) <= 25)
		    {
		    	$_SESSION['save_username'] = $username;
			    /*if (filter_var($email, FILTER_VALIDATE_EMAIL))
				  {
				    $_SESSION['save_email'] = $email;
				    $userManager = new \App\model\UserManager();
					  $checkExistUser = $userManager->existUser($username, $email);
					  if ($checkExistUser == 0)
					  {
					    if (preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password))
					    {
					    	if ($password === $confirm_password)
					    	{
					    		// Hashage du mot de passe
					    		$password = password_hash($password, PASSWORD_DEFAULT);
					    		// Génération d'une clé aléatoire de 16 caractères
					    		$length = 16;
					    		$token = bin2hex(random_bytes($length));
					    		// Ajout du nouvel utilisateur dans la base de données
					    		$new_user = new \App\model\User([
										'username' => $username,
										'email'    => $email,
										'password' => $password,
										'token'    => $token
					    		]);
									$userManager->addUser($new_user);
									// Envoi du mail et affichage de la page de confirmation
					    		$new_mail = new \App\model\Mail($email);
					    		$new_mail->send_register_mail($username, $token);
									$_SESSION['save_username'] = null;
									$_SESSION['save_email']    = null;
					   			header('Location: ./confirmation_inscription');
					   			exit;
					   		}
					   		else
					   		{
					   			$this->alert_failure('Les mots de passes renseignés doivent être identiques', 'inscription');
					   		}
					   	}
					   	else
				    	{
				    		$this->alert_failure('Le mot de passe doit contenir au moins 8 caractères avec des chiffres et des lettres majuscules et minuscules', 'inscription');
				    	}
				    }
				    else
				    {
							$_SESSION['save_username'] = null;
							$_SESSION['save_email']    = null;
				    	$this->alert_failure('Ce nom d\'utilisateur ou cette adresse email est déjà utilisé', 'inscription');
				    }
			    }
			    else
			    {
		    		$this->alert_failure('Cette adresse email n\'est pas valide', 'inscription');
			   	}*/
				}
				else
				{
					$this->alert_failure('Le nom d\'utilisateur doit faire entre 2 et 25 caractères', 'inscription');
				}
			}
			else
			{
				$this->alert_failure('Pour que votre inscription soit prise en compte, vous devez consentir à notre politique concernant les données', 'inscription');
			}
		}
		else
		{
			$this->alert_failure('Les données transmissent ne sont pas valides', 'inscription');
		}
	}
}
