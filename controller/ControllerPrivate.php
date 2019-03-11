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
			$this->alert_failure('Vous devez être connecté pour accéder à cette page ou à cette fonctionnalité !', \App\model\App::getDomainPath() . '/connexion');
			exit;
		}
	}

	/**
	 * Méthode d'affichage de la page de montage photo (studio).
	 */
	public function displayStudio()
	{
		$userData = $this->callUserData();
		$imageManager = new \App\model\ImageManager();
		$lastImages   = $imageManager->lastImages($userData);
		require('./view/viewPrivate/viewStudio.php');
	}

	/**
	 * Méthode d'affichage de la page 'Mes instashots'.
	 */
	public function displayShots($slug)
	{
		$userData     = $this->callUserData();
		$imageManager   = new \App\model\ImageManager();
		$likeManager    = new \App\model\LikeManager();
		$commentManager = new \App\model\CommentManager();
		$imageByPage = 12;
		$countImages = $imageManager->getNbrImagesById($userData);
		$totalPages = ceil($countImages / $imageByPage);
		if (isset($slug) && !empty($slug) && $slug > 0 && $slug <= $totalPages)
			$currentPage = intval($slug);
		else
			$currentPage = 1;
		$start = ($currentPage - 1) * $imageByPage;
		$allMyImages = $imageManager->getImagesById($userData, $imageByPage, $start);
		$allMyLikes = $likeManager->getLikesById($userData, $imageByPage, $start);
		$allMyComments = $commentManager->getCommentsById($userData, $imageByPage, $start);
		require('./view/viewPrivate/viewShots.php');
	}

	public function displayShotsRedirection()
	{
		$this->displayShots(1);
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

	/**
	 * Permet l'édition des données concernant l'utilisateur (nom d'utilisateur, email, mot de passe).
	 */
	public function processEditUser()
	{
		$userData = $this->callUserData();
		if (!empty($_POST)
			&& isset($_POST['username']) && !empty($_POST['username'])
			&& isset($_POST['email']) && !empty($_POST['email']))
		{
			$username = htmlspecialchars($_POST['username']);
			$email    = htmlspecialchars($_POST['email']);
			// Si on modifie le mot de passe
			if (isset($_POST['pass']) && !empty($_POST['pass'])
				&& isset($_POST['passconfirm']) && !empty($_POST['passconfirm']))
			{
				$passinit    = htmlspecialchars($_POST['pass']);
				$passconfirm = htmlspecialchars($_POST['passconfirm']);
				if (strlen($passinit) >= 8 && preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $passinit))
	    		{
					if ($passinit == $passconfirm)
						$pass = password_hash($passinit, PASSWORD_DEFAULT);
					else
					{
						$this->alert_failure('Les mots de passes renseignés doivent être identiques', 'parametres');
						exit;
					}
				}
				else
				{
					$this->alert_failure('Le mot de passe doit contenir au moins 8 caractères avec des chiffres et des lettres', 'parametres');
					exit;
				}
			// Si les inputs pour modifier le mot de passe reste vide
			}
			else
				$pass = $userData->password();
			if (strlen($username) >= 2 && strlen($username) <= 25)
			{
				if (filter_var($email, FILTER_VALIDATE_EMAIL))
	   			{
					$userManager   = new \App\model\UserManager();
					$countUserData = $userManager->existUser($username, $email);
	   				if ($countUserData <= 1)
	   				{
	   					$editUser = new \App\model\User([
							'id'       => $_SESSION['user_id'],
							'username' => $username,
							'email'    => $email,
							'password' => $pass
						]);
						$userManager->editUser($editUser);
						$_SESSION['user_username'] = $username;
						$this->alert_success('Vos informations ont bien été mises à jour !');
						header('Location: ./parametres');
						exit;
	   				}
	   				else
	   					$this->alert_failure('Ce nom d\'utilisateur ou cetter adresse email existe déjà', 'parametres');
	   			}
	   			else
	   				$this->alert_failure('Cette adresse email n\'est pas valide', 'parametres');
			}
			else
				$this->alert_failure('Le nom d\'utilisateur doit faire entre 2 et 25 caractères', 'parametres');
		}
		else
			$this->alert_failure('Les champs "Nom d\'utilisateur" et "Email" doivent être correctement remplis', 'parametres');
	}

	public function processEditPreference()
	{
		if (!empty($_POST))
		{
			if (isset($_POST['prefTheme']) && $_POST['prefTheme'] == '1')
				$prefTheme = 1;
			else
				$prefTheme = 0;
			if (isset($_POST['prefComment']) && $_POST['prefComment'] == '1')
				$prefComment = 1;
			else
				$prefComment = 0;
			if (isset($_POST['prefLike']) && $_POST['prefLike'] == '1')
				$prefLike = 1;
			else
				$prefLike = 0;
			$userManager = new \App\model\UserManager();
			$user = new \App\model\User([
				'id'          => $_SESSION['user_id'],
				'prefTheme'   => $prefTheme,
				'prefComment' => $prefComment,
				'prefLike'    => $prefLike
			]);
			$userManager->editPreference($user);
			$_SESSION['user_theme'] = $prefTheme;
			$this->alert_success('Vos préférences ont bien été mises à jour !');
			header('Location: ./parametres#preference');
			exit;
		}
		else
			$this->alert_failure('Les données transmissent ne sont pas valides', 'parametres');
	}

	public function processSaveImage()
	{
		$userData = $this->callUserData();
		if (!empty($_POST) && isset($_POST['imgHidden']) && isset($_POST['layer']))
		{
			$data     = explode(',', $_POST['imgHidden']);
			$imgData  = base64_decode($data[1]);
			$fileName = uniqid($userData->id() . '_', true) . '.png';
			$file  = './files/img/' . $fileName;
			$layer =  './files/filters/' . $_POST['layer'] . '.png';
			file_put_contents($file, $imgData);
			// Fusion des deux images.
			$dest = imagecreatefrompng($file);
			$src  = imagecreatefrompng($layer);
			$this->imagecopymerge_alpha($dest, $src, 0, 0, 0, 0, 1280, 720, 100);
			// Compression de l'image (facteur 9) et libération de la mémoire
			$success = imagepng($dest, $file, 9);
			imagedestroy($dest);
			imagedestroy($src);
	  		if ($success)
	  		{
	  			$imageManager = new \App\model\ImageManager();
	  			$image = new \App\model\Image([
					'idUser' => $_SESSION['user_id'],
					'name'   => $fileName
				]);
	  			$imageManager->addImage($image);
	  			$this->alert_success('Wow ! Que c\'est bo !');
	  			header('Location: ./studio');
	  		}
	  		else
	  			$this->alert_failure('Le montage de l\'image a échoué', 'studio');
		}
		else
			$this->alert_failure('Les données transmissent ne sont pas valides', 'studio');
	}

	private function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct)
	{
        $cut = imagecreatetruecolor($src_w, $src_h);
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
    }

    public function processDeleteImage()
    {
		if (!empty($_POST) 
			&& isset($_POST['img']) && !empty($_POST['img'])
			&& isset($_POST['page']) && ($_POST['page'] == 'mes_instashots' || $_POST['page'] == 'studio'))
		{
			$imgId = htmlspecialchars($_POST['img']);
			$page = htmlspecialchars($_POST['page']);
			$imageManager = new \App\model\ImageManager();
  			$image = new \App\model\Image([
				'id'     => $imgId,
				'idUser' => $_SESSION['user_id']
			]);
			$imageCheck = $imageManager->checkImage($image);
			if ($imageCheck == 1)
			{
				$imageName = $imageManager->getImageName($image);
				if (unlink('./files/img/' . $imageName->name))
				{
					$imageDelete = $imageManager->deleteImage($image);
					$this->alert_success('L\'instashot a bien été supprimé');
		  			header('Location: ./' . $page);
				}
				else
					$this->alert_failure('L\'image n\'a pas pu être effacé', $page);
			}
			else
				$this->alert_failure('Cette image n\'existe pas ou vous n\'avez pas les droits pour y accéder', $page);
		}
		else
			$this->alert_failure('Les données transmissent ne sont pas valides', './');
    }

    public function processNewComment()
	{
		$userData = $this->callUserData();
		if (!empty($_POST) && isset($_POST['comment'])
			&& isset($_POST['img']) && !empty($_POST['img']))
		{
			if (!empty($_POST['comment']))
			{
				$imageId = htmlspecialchars(intval($_POST['img']));
				$comment = htmlspecialchars($_POST['comment']);
				$imageManager = new \App\model\ImageManager();
				$userManager  = new \App\model\UserManager();
				$imageCheck = $imageManager->checkImageExist($imageId);
				if ($imageCheck == 1)
				{
					$commentManager = new \App\model\CommentManager();
					$commentManager->addComment($userData->id(), $imageId, $comment);
					$imageUsername = $imageManager->getImage($imageId)->username;
					$imageUser = new \App\model\User(['username' => $imageUsername]);
					$infosUser = $userManager->getUser($imageUser);
					$email = $infosUser->email();
					$prefCommentUser = $infosUser->prefComment();
					if ($prefCommentUser == 1 && $userData->username() != $imageUsername)
					{
						$new_mail = new \App\model\Mail($email);
						$new_mail->send_comment_mail($userData->username(), $imageUsername, $imageId, $comment);
					}
					$this->alert_success('Votre commentaire a bien été posté !');
		  			header('Location: ' . \App\model\App::getDomainPath() . '/shot/' . $imageId);
				}
				else
					$this->alert_failure('Cette image n\'existe pas.', \App\model\App::getDomainPath() . '/shot/' . $imageId);
			}
			else
				$this->alert_failure('Vous ne pouvez pas poster un commentaire vide.', \App\model\App::getDomainPath() . '/shot/' . $_POST['img']);
		}
		else
			$this->alert_failure('Les données transmissent ne sont pas valides', \App\model\App::getDomainPath() . '/shot/' . $_POST['img']);
	}

	public function processLike()
	{
		$userData = $this->callUserData();
		if (!empty($_POST)
			&& isset($_POST['img']) && !empty($_POST['img']))
		{
			$imageId = htmlspecialchars(intval($_POST['img']));
			$imageManager = new \App\model\ImageManager();
			$userManager  = new \App\model\UserManager();
			$imageCheck = $imageManager->checkImageExist($imageId);
			if ($imageCheck == 1)
			{
				$likeManager = new \App\model\LikeManager();
				$likeCheck = $likeManager->checkLike($userData->id(), $imageId);
				if ($likeCheck == 0)
				{
					$imageUsername = $imageManager->getImage($imageId)->username;
					$imageUser = new \App\model\User(['username' => $imageUsername]);
					$infosUser = $userManager->getUser($imageUser);
					$email = $infosUser->email();
					$prefLikeUser = $infosUser->prefLike();
					if ($prefLikeUser == 1 && $userData->username() != $imageUsername)
					{
						$new_mail = new \App\model\Mail($email);
						$new_mail->send_like_mail($userData->username(), $imageUsername, $imageId);
					}
					$likeManager->addLike($userData->id(), $imageId);
					$this->alert_success('+1');
				}
				elseif ($likeCheck == 1)
				{
					$likeManager->removeLike($userData->id(), $imageId);
					$this->alert_success('-1');
				}
				header('Location: ' . \App\model\App::getDomainPath() . '/shot/' . $imageId);
			}
			else
				$this->alert_failure('Cette image n\'existe pas.', \App\model\App::getDomainPath() . '/shot/' . $imageId);
		}
		else
			$this->alert_failure('Les données transmissent ne sont pas valides', \App\model\App::getDomainPath() . '/shot/' . $_POST['img']);
	}



}
