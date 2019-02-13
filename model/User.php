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
	private $_token;
	private $_confirm;
	private $_prefTheme;
	private $_prefComment;
	private $_prefLike;

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
	      		$this->$method($value);
	    }
	}

	//Liste des getters
	public function id() {				return $this->_id; }
	public function username() {		return $this->_username; }
	public function email() {			return $this->_email; }
	public function password() { 		return $this->_password; }
	public function token() { 			return $this->_token; }
	public function confirm() { 		return $this->_confirm; }
	public function prefTheme() { 		return $this->_prefTheme; }
	public function prefComment() { 	return $this->_prefComment; }
	public function prefLike() { 		return $this->_prefLike; }

	//Liste des setters
	public function setId($id)
	{
		$this->_id = (int) $id;
	}

	public function setUsername($username)
	{
		if (is_string($username) && strlen($username) >= 2 && strlen($username) <= 25)
			$this->_username = $username;
	}

	public function setEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
			$this->_email = $email;
	}

	public function setPassword($password)
	{
		if(preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password))
			$this->_password = $password;
	}

	public function setToken($token)
	{
		if(is_string($token))
			$this->_token = $token;
	}

	public function setConfirm($confirm)
	{
		if($confirm == 0 || $confirm == 1)
			$this->_confirm = (int) $confirm;
	}

	public function setPrefTheme($prefTheme)
	{
		if($prefTheme == 0 || $prefTheme == 1)
			$this->_prefTheme = (int) $prefTheme;
	}

	public function setPrefComment($prefComment)
	{
		if($prefComment == 0 || $prefComment == 1)
			$this->_prefComment = (int) $prefComment;
	}

	public function setPrefLike($prefLike)
	{
		if($prefLike == 0 || $prefLike == 1)
			$this->_prefLike = (int) $prefLike;
	}
}
