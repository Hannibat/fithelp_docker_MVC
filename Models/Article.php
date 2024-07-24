<?php
require_once __DIR__ . '/BaseModel.php';
require_once __DIR__ . '/CategoryArticle.php';

// Création de la classe Article

class Article extends BaseModel
{
    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $article_id correspond à l'id de l'article
     * @param string $title correspond au titre de l'article
     * @param string $containt correspond au texte du véhicule
     * @param string $picture correspond à l'image insérée dans l'article
     * @param int $category_article_id correspond à l'id de la catégorie, c'est une clé étrangère
     */

    public function __construct(
        private ?int $article_id = null,
        private ?string $title = null,
        private ?string $containt = null,
        private ?string $picture = null,
        private ?int $category_article_id = null,
    ) {
        parent::__construct();
    }

    // Les getters pour l'article

    public function getArticleId(): int
    {
        return $this->article_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContaint(): string
    {
        return $this->containt;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }

    public function getCategoryArticleId(): int
    {
        return $this->category_article_id;
    }

    // Les setters pour l'article

    public function setArticleId(int $article_id): self
    {
        $this->article_id = $article_id;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setContaint(string $containt): self
    {
        $this->containt = $containt;
        return $this;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    public function setCategoryArticleId(int $category_article_id): self
    {
        $this->category_article_id = $category_article_id;
        return $this;
    }

    // Ajouter un article

    public function addArticle(): bool
    {
        $sql = "INSERT INTO `articles` (`title`, `containt`, `picture`, `publication_date`, `category_article_id`) 
                VALUES (:title, :containt, :picture, NOW(), :category_article_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindParam(':containt', $this->containt, PDO::PARAM_STR);
        $stmt->bindParam(':picture', $this->picture, PDO::PARAM_STR);
        $stmt->bindParam(':category_article_id', $this->category_article_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lecture de tous les articles

    public function getAllArticles(): array
    {
        $sql = "SELECT `articles`.*, `types_articles`.`category_name` as `category_article` 
            FROM `articles`
            INNER JOIN `types_articles` ON `articles`.`category_article_id` = `types_articles`.`category_article_id`";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Lecture les artciles d'une seule catégorie

    public function getCategory(int $category_article_id): array
    {
        $sql = "SELECT `articles`.*, `types_articles`.`category_name` as `category_article` 
            FROM `articles`
            INNER JOIN `types_articles` ON `articles`.`category_article_id` = `types_articles`.`category_article_id`
            WHERE `articles`.`category_article_id` = :category_article_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':category_article_id', $category_article_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lecture d'un article

    public function getOneArticle(): object
    {
        $sql = "SELECT `articles`.*, `types_articles`.`category_name` as `category_article` 
        FROM `articles`
        INNER JOIN `types_articles` ON `articles`.`category_article_id` = `types_articles`.`category_article_id`
        WHERE `articles`.`article_id` = :article_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':article_id', $this->article_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Modifier un article

    public function updateArticle(): bool
    {
        $sql = "UPDATE `articles` 
                SET `title` = :title, `containt` = :containt, `picture` = :picture, `category_article_id` = :category_article_id  
                WHERE `article_id` = :article_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindParam(':containt', $this->containt, PDO::PARAM_STR);
        $stmt->bindParam(':picture', $this->picture, PDO::PARAM_STR);
        $stmt->bindParam(':article_id', $this->article_id, PDO::PARAM_INT);
        $stmt->bindParam(':category_article_id', $this->category_article_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer un article

    public function deleteArticle(): bool
    {
        $sql = "DELETE FROM `articles` WHERE `article_id` = :article_id;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':article_id', $this->article_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    
}
