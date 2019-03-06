<?php
namespace App\model;

/**
 * Permet de gérer les requêtes concernant les commentaires.
 */
class CommentManager 
{
	public function getAllComment($imageByPage, $start)
	{
		$data = App::getDb()->query('
			SELECT count(c.id_image) AS nb
			FROM image i
			LEFT JOIN comment c ON i.id = c.id_image
			GROUP BY i.id
			ORDER BY i.date DESC
			LIMIT ' . $start . ',' . $imageByPage,
		true, false);
		return $data;
	}

	public function getNbrComment($id_image)
	{
		$data = App::getDb()->prepare('
			SELECT c.id_image
			FROM comment c
			WHERE c.id_image = :id_image',
		['id_image' => $id_image],
		true, false, true);
		return $data;
	}

	/**
	 * Permet d'ajouter un nouveau commentaire.
	 * @param int $id_user Id de l'utilisateur qui poste le commentaire.
	 * @param int $id_image Id de l'image à laquelle ajouter le commentaire.
	 * @param varchar $comment Contenu du commentaire.
	 */
	public function addComment($id_user, $id_image, $comment)
	{
		$data = App::getDb()->prepare('
			INSERT INTO 
				comment (id_user, id_image, content, date) 
			VALUES 
				(:id_user, :id_image, :content, NOW())',
			['id_user' => $id_user,
			'id_image' => $id_image,
			'content' => $comment],
		false);
	}

	/**
	 * Permet de récupérer tous les commentaires d'une image par son id.
	 * @param int $id_image Id de l'image pour laquelle retourner des commentaires.
	 */
	public function getComments($id_image)
	{
		$data = App::getDb()->prepare('
			SELECT c.id_user, u.username, c.id_image, c.content, DATE_FORMAT(c.date, "%e %M %Y à %Hh%i") AS comment_date
			FROM comment c
			LEFT JOIN user u ON u.id = c.id_user
			WHERE c.id_image = :id_image
			ORDER BY c.date DESC',
			['id_image' => $id_image],
		true, false, false);
		return $data;
	}
}