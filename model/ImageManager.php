<?php
namespace App\model;

/**
 * Permet de gérer les requêtes concernant les utilisateurs.
 */
class ImageManager
{
	/**
	 * Permet d'insérer le nom de l'image générer dans la base de données.
	 * @param Image $image Prends l'objet Image en paramètre.
	 */
	public function addImage(Image $image)
	{
		$data = App::getDb()->prepare('
			INSERT INTO 
				image (id_user, name, date) 
			VALUES 
				(:id_user, :name, NOW())',
			['id_user' => $image->idUser(),
			'name' => $image->name()],
		false);
	}

	/**
	 * Permet de supprimer une image.
	 */
	public function deleteImage(Image $image)
	{
		$data = App::getDb()->prepare('
			DELETE FROM image
			WHERE id = :id',
			['id' => $image->id()],
		false);
	}

	/**
	 * Permet de récupérer le nom de l'image a partir de son id.
	 */
	public function getImageName(Image $image)
	{
		$data = App::getDb()->prepare('
			SELECT name
			FROM image
			WHERE id = :id',
			['id' => $image->id()],
		true, true, false);
		return $data;
	}

	public function getImage($id)
	{
		$data = App::getDb()->prepare('
			SELECT i.id, i.id_user, u.username, i.name, DATE_FORMAT(i.date, "%e %M %Y à %Hh%i") AS comment_date, count(l.id_user) AS nbLike, count(c.content) AS nbComment
			FROM image i
			LEFT JOIN `like` l ON i.id = l.id_image
			LEFT JOIN comment c ON i.id = c.id_image
			LEFT JOIN user u ON i.id_user = u.id
			WHERE i.id = :id
			GROUP BY i.name',
			['id' => $id],
		true, true, false);
		return $data;
	}

	/**
	 * Récupérer les 20 derniers photos pour l'affichage de la galerie.
	 */
	public function getImages($imageByPage, $start)
	{
		$data = App::getDb()->query('
			SELECT i.id, i.id_user, u.username, i.name, i.date, count(l.id_user) AS nbLike, count(c.content) AS nbComment
			FROM image i
			LEFT JOIN `like` l ON i.id = l.id_image
			LEFT JOIN comment c ON i.id = c.id_image
			LEFT JOIN user u ON i.id_user = u.id
			GROUP BY i.name
			ORDER BY i.date DESC
			LIMIT ' . $start . ',' . $imageByPage,
		true, false);
		return $data;
	}

	/**
	 * Permet d'obtenir une photo par son id. 
	 * @param User $user Prends l'objet User en paramètre.
	 */
	public function getImagesById(User $user, $imageByPage, $start)
	{
		$data = App::getDb()->prepare('
			SELECT i.id, i.id_user, i.name, i.date, count(l.id_user) AS nbLike, count(c.content) AS nbComment
			FROM image i
			LEFT JOIN `like` l ON i.id = l.id_image
			LEFT JOIN comment c ON i.id = c.id_image
			WHERE i.id_user = :id_user
			GROUP BY i.name
			ORDER BY i.date DESC
			LIMIT ' . $start . ',' . $imageByPage,
			['id_user' => $user->id()],
		true, false, false);
		return $data;
	}

	/**
	 * Permet de connaitre le nombre total de photo pour effectuer la pagination.
	 */
	public function getNbrImages()
	{
		$data = App::getDb()->query('
			SELECT *
			FROM image',
		true, false, true);
		return $data;
	}

	/**
	 * Permet de connaitre le nombre total de photo pour effectuer la pagination.
	 */
	public function getNbrImagesById(User $user)
	{
		$data = App::getDb()->prepare('
			SELECT *
			FROM image i
			WHERE i.id_user = :id_user',
			['id_user' => $user->id()],
		true, false, true);
		return $data;
	}


	/**
	 * Permet de vérifier si un utilisateur peux accéder à une photo en particulier.
	 * @param Image $image Prends l'objet Image en paramètre.
	 */
	public function checkImage(Image $image)
	{
		$data = App::getDb()->prepare('
			SELECT *
			FROM image i
			WHERE 
				i.id = :id
				AND i.id_user = :id_user',
			['id' => $image->id(),
			'id_user' => $image->idUser()],
		true, false, true);
		return $data;
	}

	public function checkImageExist($id)
	{
		$data = App::getDb()->prepare('
			SELECT *
			FROM image i
			WHERE 
				i.id = :id',
			['id' => $id],
		true, false, true);
		return $data;
	}

	/**
	 * Permet de retourner les 4 dernières images prises par l'utilisateur en cours.
	 * @param User $user Prends l'objet User en paramètre.
	 */
	public function lastImages(User $user)
	{
		$data = App::getDb()->prepare('
			SELECT *
			FROM image i
			WHERE i.id_user = :id_user
			ORDER BY i.date DESC
			LIMIT 4',
			['id_user' => $user->id()],
		true, false, false);
		return $data;
	}
}