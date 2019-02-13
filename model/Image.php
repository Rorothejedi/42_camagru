<?php
namespace App\model;

/**
 * Constitue l'objet Image tel qu'il est conçu dans le champ "image" de la base de données.
 */
class Image
{
	private $_id;
	private $_id_user;
	private $_name;
	private $_date;

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
    		$method = 'set' . ucfirst($key);  
	    	if (method_exists($this, $method))
	      		$this->$method($value);
	    }
	}

	//Liste des getters
	public function id() {		return $this->_id; }
	public function idUser() {	return $this->_id_user; }
	public function name() {	return $this->_name; }
	public function date() {	return $this->_date; }

	//Liste des setters
	public function setId($id)
	{
		$this->_id = (int) $id;
	}

	public function setIdUser($id_user)
	{
		$this->_id_user = (int) $id_user;
	}

	public function setName($name)
	{
		if (is_string($name) && strlen($name) <= 255)
			$this->_name = $name;
	}

	public function setDate($date)
	{
		if ($date instanceof DateTime)
            $this->_date = $date;
	}
}