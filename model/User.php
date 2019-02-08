<?php
namespace App\model;

/**
 * Constitue l'objet User tel qu'il est conçu dans le champ "user" de la base de données.
 */
class User
{
	private $_id;
	private $_username;
	private $_email;
	private $_password;
	private $_preference;
	private $_token;
	private $_confirm;

	/**
	 * Permet d'hydrater l'objet dès sa construction.
	 * @param object $data Objet contenant certaines informations concernant un projet.
	 */
	public function __construct($data)
	{
		$this->hydrate($data);
	}

	/**
	 * Méthode d'hydratation
	 * @param  objet $data Objet contenant certaines informations concernant un projet.
	 */
	public function hydrate($data)
	{
		foreach ($data as $key => $value)
  		{
    	// On récupère le nom du setter correspondant à l'attribut
    	$method = 'set' . ucfirst($key);  

	    	// Si le setter correspondant existe
	    	if (method_exists($this, $method))
	    	{
	      		// On appelle le setter
	      		$this->$method($value);
	    	}
	    }
	}

	//Liste des getters
	public function id() { 				 return $this->_id; }
	public function username() {    	 return $this->_username; }
	public function email() { 			 return $this->_email; }
	public function password() { 		 return $this->_password; }
	public function preference() { 		 return $this->_preference; }
	public function token() { 			 return $this->_token; }
	public function confirm() { 		 return $this->_confirm; }

	//Liste des setters
	public function setId($id)
	{
		$this->_id = (int) $id;
	}

	public function setUsername($username)
	{
		if (is_string($username) && strlen($username) >= 2 && strlen($username) <= 25)  
		{
			$this->_username = $username;
		}
	}

	public function setEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$this->_email = $email;
		}
	}

	public function setPassword($password)
	{
		if(preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password))
		{
			$this->_password = $password;
		}
	}

	public function setPreference($preference)
	{
		if($preference == 0 || $preference == 1)
		{
			$this->_preference = (int) $preference;
		}
	}

	public function setToken($token)
	{
		if(is_string($token))
		{
			$this->_token = $token;
		}
	}

	public function setConfirm($confirm)
	{
		if($confirm == 0 || $confirm == 1)
		{
			$this->_confirm = (int) $confirm;
		}
	}
}
