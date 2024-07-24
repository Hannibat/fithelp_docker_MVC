<?php
require_once __DIR__ . '/BaseModel.php';

// Création de la classe Comment

class Comment extends BaseModel
{
    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $comment_id correspond à l'id du commentaire
     * @param string $content correspond au contenu du commentaire
     * @param bool $publicate correspond à la publication du commentaire
     * @param int $user_id correspond à l'id de l'utilisateur, c'est une clé étrangère
     * @param int $article_id correspond à l'id de l'article, c'est une clé étrangère
     */

    public function __construct(
        private ?int $comment_id = null,
        private ?string $content = null,
        private ?bool $publicate = null,
        private ?int $user_id = null,
        private ?int $article_id = null
    ) {
        parent::__construct();
    }

    // Les getters pour le commentaire

    public function getCommentId(): int
    {
        return $this->comment_id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getPublicate(): bool
    {
        return $this->publicate;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getArticleId(): int
    {
        return $this->article_id;
    }

    // Les setters pour le commentaire

    public function setCommentId(int $comment_id): self
    {
        $this->comment_id = $comment_id;
        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function setPublicate(bool $publicate): self
    {
        $this->publicate = $publicate;
        return $this;
    }

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

    // Ajouter un commentaire

    public function addComment(): bool
    {
        $sql = "INSERT INTO `comments` (`content`, `publication_date`, `publicate`, `user_id`, `article_id`) 
                VALUES (:content, :publication_date, :publicate, :user_id, :article_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':content', $this->content, PDO::PARAM_STR);
        $stmt->bindParam(':publicate', $this->publicate, PDO::PARAM_BOOL);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':article_id', $this->article_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lecture de tous les commentaires

    public function getAllComments(): array
    {
        $sql = "SELECT `comments`.*, `users`.`user_name` as `user_name`, `articles.title` as `article_title`
                FROM `comments`
                INNER JOIN `users` ON `comments`.`user_id` = `users`.`user_id`
                INNER JOIN `articles` ON `comments`.article_id = `articles`.`article_id`";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Lecture d'un commentaire

    public function getOneComment(): ?array
    {
        $sql = "SELECT `comments`.*, `users`.`user_name` as `user_name`, `articles`.`title` as `article_title`
                FROM `comments`
                INNER JOIN `users` ON `comments`.`user_id` = `users`.`user_id`
                INNER JOIN `articles` ON `comments`.`article_id` = `articles`.`article_id`
                WHERE `comments`.`comment_id` = :comment_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':comment_id', $this->comment_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row ?: null;
    }

    // Modifier un commentaire

    public function updateComment(): bool
    {
        $sql = "UPDATE `comments` 
                SET `content` = :content, `publicate` = :publicate, `user_id` = :user_id, `article_id` = :article_id
                WHERE `comment_id` = :comment_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':content', $this->content, PDO::PARAM_STR);
        $stmt->bindParam(':publicate', $this->publicate, PDO::PARAM_BOOL);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':article_id', $this->article_id, PDO::PARAM_INT);
        $stmt->bindParam(':comment_id', $this->comment_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer un commentaire

    public function deleteComment(): bool
    {
        $sql = "DELETE FROM `comments` WHERE `comment_id` = :comment_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':comment_id', $this->comment_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
