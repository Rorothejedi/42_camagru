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
	 * Méthode d'affichage de la page mot de passe oublié.
	 */
	public function displayPassForgotten()
	{
		require('./view/viewPublic/viewPassForgotten.php');
	}

	/**
	 * Méthode d'affichage de la page des mentions légales.
	 */
	public function displayLegal()
	{
		require('./view/viewPublic/viewLegal.php');
	}

	/**
	 * Méthode d'affichage de la page de réinitialisation du mot de passe utilisateur. Vérification de la validité des informations avant l'accès à la page 'nouveau_mot_de_passe' par un utilisateur.
	 */
	public function displayPassNew()
	{
		if (isset($_GET['username']) && !empty($_GET['username'])
			&& isset($_GET['key']) && !empty($_GET['key']))
		{
			$username = htmlspecialchars($_GET['username']);
			$token    = htmlspecialchars($_GET['key']);
			$user        = new \App\model\User(['username' => $username]);
			$userManager = new \App\model\UserManager();
			$currentUser = $userManager->getUser($user);
			if ($currentUser->token() == $token)
				require('./view/viewPublic/viewPassNew.php');
			else
				$this->alert_failure('Les données transmises ne correspondent pas aux données de l\'utilisateur', 'mot_de_passe_oublie');
		}
		else
			$this->alert_failure('Les données transmises ne sont pas valides', 'mot_de_passe_oublie');
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
				    if (filter_var($email, FILTER_VALIDATE_EMAIL))
					  {
					    $_SESSION['save_email'] = $email;
					    $userManager = new \App\model\UserManager();
						$checkExistUser = $userManager->existUser($username, $email);
						if ($checkExistUser == 0)
						{
						    if (preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $pass))
						    {
						    	if ($pass === $passconfirm)
						    	{
						    		// Hashage du mot de passe
						    		$pass = password_hash($pass, PASSWORD_DEFAULT);
						    		// Génération d'une clé aléatoire de 16 caractères
						    		$length = 16;
						    		$token = bin2hex(random_bytes($length));
						    		// Ajout du nouvel utilisateur dans la base de données
						    		$new_user = new \App\model\User([
										'username' => $username,
										'email'    => $email,
										'password' => $pass,
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
						   			$this->alert_failure('Les mots de passes renseignés doivent être identiques', 'inscription');
						   	}
						   	else
					    		$this->alert_failure('Le mot de passe doit contenir au moins 8 caractères avec des chiffres et des lettres majuscules et minuscules', 'inscription');
					    }
					    else
					    {
							$_SESSION['save_username'] = null;
							$_SESSION['save_email']    = null;
					    	$this->alert_failure('Ce nom d\'utilisateur ou cette adresse email est déjà utilisé', 'inscription');
					    }
				    }
				    else
			    		$this->alert_failure('Cette adresse email n\'est pas valide', 'inscription');
				}
				else
					$this->alert_failure('Le nom d\'utilisateur doit faire entre 2 et 25 caractères', 'inscription');
			}
			else
				$this->alert_failure('Pour que votre inscription soit prise en compte, vous devez consentir à notre politique concernant les données', 'inscription');
		}
		else
			$this->alert_failure('Les données transmissent ne sont pas valides', 'inscription');
	}

	/**
	 * Permet la connexion d'un utilisateur avec son email ou son nom d'utilisateur. Si l'utilisateur n'a pas préalablement validé son adresse mail en cliquant sur le lien du mail envoyé, un mail lui est renvoyé en entrant ses identifiants. Si celui-ci coche la case "se souvenir de moi", un cookie est créer et des variables de session (id, username) sont initialisées dans tous les cas.
	 */
	public function processConnection()
	{
		if (isset($_POST['username']) && !empty($_POST['username']) 
			&& isset($_POST['pass']) && !empty($_POST['pass'])) 
		{
			$username = htmlspecialchars($_POST['username']);
			$password = htmlspecialchars($_POST['pass']);
			if (filter_var($username, FILTER_VALIDATE_EMAIL)) 
				$newUser = new \App\model\User(['email' => $username]);
			else
				$newUser = new \App\model\User(['username' => $username]);
			$userManager = new \App\model\UserManager();
			$connectData = $userManager->getUser($newUser);
			if ($username == $connectData->username() || $username == $connectData->email()) 
			{
				$_SESSION['save_username'] = $username;
				if (password_verify($password, $connectData->password())) 
				{
					if ($connectData->confirm() == '0') 
					{
						// Envoi du mail et alerte de confirmation
				    	$new_mail = new \App\model\Mail($connectData->email());
				    	$new_mail->send_register_mail($connectData->username(), $connectData->token());
						$this->alert_success('Un mail viens de vous être renvoyé pour que vous puissiez valider votre compte. Vérifiez vos spam !');
						header('Location: ./confirmation_inscription');
					}
					else
					{
						$_SESSION['save_username'] = null;
						$_SESSION['user_id']       = $connectData->id();
						$_SESSION['user_username'] = $connectData->username();
						// Si l'utilisateur a coché la case "Se souvenir de moi"
						if (isset($_POST['remember'])) 
						{
							setcookie('auth', $connectData->id() . '---' . sha1($connectData->username() . $connectData->password() . $_SERVER['REMOTE_ADDR']), time() + 3600 * 24 * 365, null, null, false, true);
						}
						header('Location: ./');
						exit;
					}
				}
				else
					$this->alert_failure('Mot de passe incorrect', 'connexion');
			}
			else
				$this->alert_failure('Cet utilisateur n\'existe pas', 'connexion');
		}
		else
			$this->alert_failure('Les données transmissent ne sont pas valides', 'connexion');
	}

	/**
	 * Méthode d'affichage et de traitement des données de la page de validation de l'inscription avec gestion des erreurs.
	 * Récupère les données en GET (username et key) pour vérifier la concordance avec celles de la base de données. Si elles sont conforment, le compte de l'utilisateur est validé.
	 */
	public function processValidation()
	{
		if (isset($_GET['username']) && !empty($_GET['username'])
			&& isset($_GET['key']) && !empty($_GET['key']))
		{
			$username = htmlspecialchars($_GET['username']);
			$token    = htmlspecialchars($_GET['key']);
			$user        = new \App\model\User(['username' => $username]);
			$userManager = new \App\model\UserManager();
			$currentUser = $userManager->getUser($user);
			if ($currentUser->confirm() == '0')
			{
				if ($token == $currentUser->token())
				{
					$userManager->validateUser($user);
					$this->alert_success('Votre compte a bien été validé ! Bienvenue !');
					header('Location: ./');
				}
				else
					$this->alert_failure('Erreur ! Votre compte ne peut pas être activé', './');
			}
			elseif ($currentUser->confirm() == '1')
			{
				$this->alert_success('Votre compte est déjà actif');
				header('Location: ./connexion');
				exit;
			}
			else
				$this->alert_failure('Une erreur est survenue', 'connexion');
		}
		else
			$this->alert_failure('Les données transmises ne sont pas valides', './');
	}

	/**
	 * Permet la génération d'un token et l'envoi d'un mail contenant celui-ci à l'adresse mail renseigné pour que l'utilisateur puisse modifier son mot de passe.
	 */
	public function processPassForgotten()
	{
		if (isset($_POST['email']) && !empty($_POST['email']))  
		{
			$email = htmlspecialchars($_POST['email']);
			$length = 16;
			$token  = bin2hex(random_bytes($length));
			$user        = new \App\model\User(['email' => $email]);
			$userManager = new \App\model\UserManager();
			$currentUser = $userManager->getUser($user);
			if ($email == $currentUser->email())
			{
				$currentUser->setToken($token);
				$userManager->editUser($currentUser);
				$new_mail = new \App\model\Mail($currentUser->email());
				$new_mail->send_forgot_pass_mail($currentUser->username(), $currentUser->token());
				$this->alert_success('Un mail viens de vous être envoyé pour que vous puissiez réinitiliser votre mot de passe. Vérifiez vos spam !');
				header('Location: ./mot_de_passe_oublie');
				exit();
			}
			else
				$this->alert_failure('Cette adresse email n\'existe pas', 'mot_de_passe_oublie');
		}
		else
			$this->alert_failure('Les données transmissent ne sont pas valides', 'mot_de_passe_oublie');
	}

	/**
	 * Permet la création d'un nouveau mot de passe pour l'utilisateur qui en a fait la demande. Récupére les données (GET et POST), vérifie l'authenticité des données et du mot de passe et enregistre ce dernier dans la base de données.
	 */
	public function processPassNew()
	{
		if (isset($_POST['pass']) && !empty($_POST['pass']) 
			&& isset($_POST['passconfirm']) && !empty($_POST['passconfirm'])
			&& isset($_GET['username']) && !empty($_GET['username'])
			&& isset($_GET['key']) && !empty($_GET['key'])) 
		{
			$pass        = htmlspecialchars($_POST['pass']);
			$passconfirm = htmlspecialchars($_POST['passconfirm']);
			$username    = htmlspecialchars($_GET['username']);
			$token       = htmlspecialchars($_GET['key']);
			if (preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $pass)) 
			{
				if ($pass === $passconfirm)
				{
	    			$pass = password_hash($pass, PASSWORD_DEFAULT);
	    			$user        = new \App\model\User(['username' => $username]);
					$userManager = new \App\model\UserManager();
					$currentUser = $userManager->getUser($user);
					if ($currentUser->token() == $token) 
					{
						$userEdit = new \App\model\User([
							'username' => $currentUser->username(),
							'email' => $currentUser->email(),
							'password' => $pass,
							'token' => null
						]);
						$userManager->editUser($userEdit);
						$this->alert_success('Votre nouveau mot de passe à bien été enregistré, vous pouvez vous connecter !');
						header('Location: ./connexion');
						exit();
					}
					else
				   		$this->alert_failure('Les données transmises ne correspondent pas aux données de l\'utilisateur', 'nouveau_mot_de_passe&username=' . $_GET['username'] . '&key=' . $_GET['key']);
	    		}
	    		else
				   $this->alert_failure('Les mots de passes renseignés doivent être identiques', 'nouveau_mot_de_passe&username=' . $_GET['username'] . '&key=' . $_GET['key']);
	    	}
	    	else
				$this->alert_failure('Le mot de passe doit contenir au moins 8 caractères avec des chiffres et des lettres majuscules et minuscules', 'nouveau_mot_de_passe&username=' . $_GET['username'] . '&key=' . $_GET['key']);
		}
		else
			$this->alert_failure('Les données transmissent ne sont pas valides', 'nouveau_mot_de_passe&username=' . $_GET['username'] . '&key=' . $_GET['key']);
	}
}
