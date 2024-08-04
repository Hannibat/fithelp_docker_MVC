<?php
require_once __DIR__ . '/BaseModel.php';

// Création de la classe Like

class Like extends BaseModel
{
    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $user_id correspond à l'id de l'utilisateur
     * @param int $article_id correspond à l'id de l'article
     */

    public function __construct(
        private ?int $user_id = null,
        private ?int $article_id = null
    ) {
        parent::__construct();
    }

    // Les getters pour le like

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getArticleId(): int
    {
        return $this->article_id;
    }

    // Les setters pour le like

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function setArticleId(int $article_id): self
    {
        $this->article_id = $article_id;
        return $this;
    }

    // Ajouter un like sur un article

    public function addLike(): bool
    {
        $sql = 'INSERT INTO `like` (`user_id`, `article_id`) 
                VALUES (:user_id, :article_id);';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindValue(':article_id', $this->article_id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    // Lire tous les likes d'artciles d'un utilisateur

    public function getUserLikes(int $user_id): array
    {
        $sql = 'SELECT `articles`.* 
                FROM `like`
                INNER JOIN `articles` ON `like`.`article_id` = `articles`.`article_id`
                WHERE `like`.`user_id` = :user_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lire tous les likes sur un article

    public function getArticleLikes(int $article_id): array
    {
        $sql = 'SELECT `users`.* 
                FROM `like`
                INNER JOIN `users` ON `like`.`user_id` = `users`.`user_id`
                WHERE `like`.`article_id` = :article_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':article_id', $article_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Supprimer un like d'article

    public function removeLike(): bool
    {
        $sql = 'DELETE FROM `like` WHERE `user_id` = :user_id AND `article_id` = :article_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindValue(':article_id', $this->article_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
