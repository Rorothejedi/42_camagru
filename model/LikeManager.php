<?php
namespace App\model;

/**
 * Permet de gérer les requêtes concernant les likes.
 */
class LikeManager 
{
	public function getAllLike($imageByPage, $start)
	{
		$data = App::getDb()->query('
			SELECT COUNT(l.id_image) AS nb
			FROM image i
			LEFT JOIN `like` l ON i.id = l.id_image
			GROUP BY i.id
			ORDER BY i.date DESC
			LIMIT ' . $start . ',' . $imageByPage,
		true, false);
		return $data;
	}

	public function getLike($id_image)
	{
		$data = App::getDb()->prepare('
			SELECT l.id_image
			FROM `like` l
			WHERE l.id_image = :id_image',
		['id_image' => $id_image],
		true, false, true);
		return $data;
	}

	public function getLikesById(User $user, $imageByPage, $start)
	{
		$data = App::getDb()->prepare('
			SELECT COUNT(l.id_image) AS nb
			FROM image i
			LEFT JOIN `like` l ON i.id = l.id_image
            WHERE i.id_user = :id_user
			GROUP BY i.id
			ORDER BY i.date DESC
			LIMIT ' . $start . ',' . $imageByPage,
			['id_user' => $user->id()],
		true, false, false);
		return $data;
	}

	/**
	 * Permet d'ajouter un like à une image.
	 * @param int $id_user  Id de l'utilisateur en cours.
	 * @param int $id_image Id de l'image à liker.
	 */
	public function addLike($id_user, $id_image)
	{
		$data = App::getDb()->prepare('
			INSERT INTO 
				`like` (id_user, id_image)
			VALUES 
				(:id_user, :id_image)',
			['id_user' => $id_user,
			'id_image' => $id_image],
		false);
	}

	/**
	 * Permet de vérifier si un utilisateur a déjà liké une image.
	 * @param int $id_user  Id de l'utilisateur en cours.
	 * @param int $id_image Id de l'image à vérifier.
	 */
	public function checkLike($id_user, $id_image)
	{
		$data = App::getDb()->prepare('
			SELECT * 
			FROM `like`
			WHERE
				id_user = :id_user 
				AND id_image = :id_image',
			[':id_user' => $id_user,
			':id_image'     => $id_image],
		true, false, true);
		return $data;
	}

	/**
	 * Permet de retirer le like d'un utilisateur sur une image0
	 * @param int $id_user  Id de l'utilisateur en cours.
	 * @param int $id_image Id de l'image pour laquelle retiré le like.
	 */
	public function removeLike($id_user, $id_image)
	{
		$data = App::getDb()->prepare('
			DELETE FROM `like`
			WHERE 
				id_user = :id_user
				AND id_image = :id_image',
			['id_user' => $id_user,
			'id_image' => $id_image],
		false);
	}
}