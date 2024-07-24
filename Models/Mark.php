<?php
require_once __DIR__ . '/BaseModel.php';

// Création de la classe Mark

class Mark extends BaseModel
{
    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $user_id correspond à l'id de l'utilisateur
     * @param int $exercice_id correspond à l'id de l'exercice
     */

    public function __construct(
        private ?int $user_id = null,
        private ?int $exercice_id = null
    ) {
        parent::__construct();
    }

    // Les getters pour la table Mark

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getExerciceId(): int
    {
        return $this->exercice_id;
    }

    // Les setters pour la table Mark

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function setExerciceId(int $exercice_id): self
    {
        $this->exercice_id = $exercice_id;
        return $this;
    }

    // Ajouter un marqueur favori d'une exercice

    public function addMark(): bool
    {
        $sql = "INSERT INTO `mark` (`user_id`, `exercice_id`) 
                VALUES (:user_id, :exercice_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':exercice_id', $this->exercice_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    
    // Lire tous les marqueurs favoris d'un exercice d'un utilisateur
    
    public function getUserMarks(int $user_id): array
    {
        $sql = "SELECT `exercices`.* 
                FROM `mark`
                INNER JOIN `exercices` ON `mark`.`exercice_id` = `exercices`.`exercice_id`
                WHERE `mark`.`user_id` = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    // Lire tous les un marqueurs favoris pour un exercice
    
    public function getExerciceMarks(int $exercice_id): array
    {
        $sql = "SELECT `users`.* 
                FROM `mark`
                INNER JOIN `users` ON `mark`.`user_id` = `users`.`user_id`
                WHERE `mark`.`exercice_id` = :exercice_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':exercice_id', $exercice_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Supprimer un marqueur favori d'un exercice

    public function removeMark(): bool
    {
        $sql = "DELETE FROM `mark` WHERE `user_id` = :user_id AND `exercice_id` = :exercice_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':exercice_id', $this->exercice_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
?>
