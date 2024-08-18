<?php
require_once __DIR__ . '/BaseModel.php';

// Création de la classe CategoryArticle

class CategoryArticle extends BaseModel
{

    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $category_article_id correspond à l'id de la categorie, cela servira pour le véhicule
     * @param string $category_name correspond au nom de la catégorie, cela sera associer à un id
     */

    public function __construct(protected ?int $category_article_id = null, protected ?string $category_name = null)
    {
        parent::__construct();
    }

    // Les getters pour l'id et le nom de l'article

    public function getCategoryArticleId(): int 
    {
        return $this->category_article_id;
    }

    public function getCategoryName(): string 
    {
        return $this->category_name;
    }

    // Les setters pour l'id et le nom de l'article

    public function setCategoryArticleId(int $category_article_id): self 
    {
        $this->category_article_id = $category_article_id;
        return $this;
    }

    public function setCategoryName(string $category_name): self 
    {
        $this->category_name = $category_name;
        return $this;
    }

    // Création

    public function addCategoryArticle(): bool {
        $sql = 'INSERT INTO `types_articles` (`category_name`) VALUES (:category_name);';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':category_name', $this->category_name, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Lecture une catégorie

    public static function getOneCategoryArticle($category_article_id): object 
    {
        $sql = 'SELECT * FROM `types_articles` WHERE `category_article_id` = :category_article_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':category_article_id', $category_article_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Lecture liste des catégories

    public static function getAllCategoriesArticles(): array 
    {
        $sql = 'SELECT * FROM `types_articles`;';
        $stmt = Database::connect()->query($sql);
        return $stmt->fetchAll();
    }

    // Mettre à jour une catégorie

    public function updateCategoryArticle(): bool 
    {
        $sql = 'UPDATE `types_articles` SET `category_name` = :category_name WHERE `category_article_id` = :category_article_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':category_name', $this->category_name, PDO::PARAM_STR);
        $stmt->bindValue(':category_article_id', $this->category_article_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer une catégorie

    public static function deleteCategoryArticle($category_article_id): bool 
    {
        $sql = 'DELETE FROM `types_articles` WHERE `category_article_id` = :category_article_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':category_article_id', $category_article_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
