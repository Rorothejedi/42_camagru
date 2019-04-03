<?php
namespace App\model;

/**
 * Permet les envois de mails dans les cas d'inscription et de mot de passe oubliés
 */
class Mail
{
	private $email;

	/* --------------------- For XAMPP  ----------------------*/
	private $from = 'no-reply@cabotiau.com';
	private $host = 'http://localhost/camagru/';
	/* ------------------ For Custom MAMP  -------------------*/
	//private $from = 'rcabotia@student.le-101.fr';
	//private $host = 'http://localhost:8100';

	public function __construct($email)
	{
		$this->email = $email;
	}

	/**
	 * Permet l'envoi d'un mail à l'utilisateur pour qu'il puisse activer son compte
	 * @param  string $email 	Nom d'utilisateur
	 * @param  string $key      Token nécessaire pour accéder à la page de validation du compte
	 */
	public function send_register_mail($username, $key)
	{
		$subject = "Instagru | Confirmation d'inscription";
		$link = $this->host . "processValidation".
				"&username=" . urlencode($username) .
				"&key=". urlencode($key);
		$message = "
		<html>
			<body>
				<center>
					<h1 style='color:#66DDB3;padding-bottom:30px'>Bienvenue sur Instagru !</h1>
					<p>Merci de nous rejoindre <strong style='color:#66DDB3'>" . $username . "</strong>, mais avant cela il vous reste une ultime étape !<br> Pour accèder à votre espace et commencer à profiter de nos services, merci de confirmer votre inscription.</p>
					<br>
					<a href='" . $link . "' style='background-color:white; padding: 5px 10px; border: 3px solid #66DDB3; border-radius: 20px; color:#66DDB3; text-decoration:none;margin-top:30px'>Confirmer l'inscription</a>
					<br><br>
					<small>Cet email est automatique, merci de ne pas y répondre.</small>
				</center>
			</body>
		</html>";

		$this->configurationMail($subject, $message);
	}

	/**
	 * Permet l'envoi d'un mail à l'adresse renseigné par l'utilisateur pour que celui-ci puisse réinitialiser son mot de passe.
	 * @param  string $email Nom d'utilisateur
	 * @param  string $key   Token nécessaire pour accéder à la page de réinitialisation de mot de passe
	 */
	public function send_forgot_pass_mail($username, $key)
	{
		$subject = "Instagru | Réinitialisation du mot de passe";
		$link = $this->host . "nouveau_mot_de_passe".
				"&username=" . urlencode($username) .
				"&key=". urlencode($key);
		$message = "
		<html>
			<body>
				<center>
					<h1 style='color:#66DDB3;padding-bottom:30px'>Instagru | Réinitialisation de votre mot de passe</h1>
					<p>Votre nom d'utilisateur : <strong>" . $username . "</strong></p>
					<p>Cliquez sur le bouton ci-dessous pour accèder à la page vous permettant de réinitialiser votre mot de passe.</p>
					<br>
					<a href='" . $link . "' style='background-color:white; padding: 5px 10px; border: 3px solid #66DDB3; border-radius: 20px; color:#66DDB3; text-decoration:none;margin-top:30px'>Réinitialiser mot de passe</a>
					<br><br>
					<small>Cet email est automatique, merci de ne pas y répondre.</small>
				</center>
			</body>
		</html>";

		$this->configurationMail($subject, $message);
	}

	public function send_comment_mail($currentUsername, $username, $id_image, $comment)
	{
		$subject = "Instagru | " . $currentUsername . " a commenté un de vos shot !";
		$link = $this->host . "shot/" . $id_image;
		$message = "
		<html>
			<body>
				<center>
					<h1 style='color:#66DDB3;padding-bottom:30px'>Instagru</h1>
					<p>Un de vos instashot vient d'être commenté par <strong style='color:#66DDB3'>" . $currentUsername . "</strong> ! Voici son commentaire :</p>
					<p><em>" . $comment . "</em></p>
					<br>
					<a href='" . $link . "' style='background-color:white; padding: 5px 10px; border: 3px solid #66DDB3; border-radius: 20px; color:#66DDB3; text-decoration:none;margin-top:30px'>Votre instashot</a>
					<br><br>
					<small>Cet email est automatique, merci de ne pas y répondre.</small>
				</center>
			</body>
		</html>";

		$this->configurationMail($subject, $message);
	}

	public function send_like_mail($currentUsername, $username, $id_image)
	{
		$subject = "Instagru | " . $currentUsername . " a liké un de vos shot !";
		$link = $this->host . "shot/" . $id_image;
		$message = "
		<html>
			<body>
				<center>
					<h1 style='color:#66DDB3;padding-bottom:30px'>Instagru</h1>
					<p>Un de vos instashot vient d'être liké par <strong style='color:#66DDB3'>" . $currentUsername . "</strong> !</p>
					<br>
					<a href='" . $link . "' style='background-color:white; padding: 5px 10px; border: 3px solid #66DDB3; border-radius: 20px; color:#66DDB3; text-decoration:none;margin-top:30px'>Votre instashot</a>
					<br><br>
					<small>Cet email est automatique, merci de ne pas y répondre.</small>
				</center>
			</body>
		</html>";

		$this->configurationMail($subject, $message);
	}

	private function configurationMail($subject, $message)
	{
		$header = "From: Instagru <" . $this->from . ">\r\n";
		$header .= "Reply-To: Instagru <" . $this->from . ">\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html; charset=utf-8\r\n";
		$header .= "Content-Transfer-Encoding: 8bit\r\n";
		$header .= "X-Mailer: PHP/" . phpversion() . "\r\n";

		mail($this->email, $subject, $message, $header, '-f' . $this->from);
	}
}
