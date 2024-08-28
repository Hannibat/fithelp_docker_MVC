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
        private ?int $exercise_id = null
    ) {
        parent::__construct();
    }

    // Les getters pour la table Mark

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getExerciseId(): int
    {
        return $this->exercise_id;
    }

    // Les setters pour la table Mark

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function setExerciseId(int $exercise_id): self
    {
        $this->exercise_id = $exercise_id;
        return $this;
    }

    // Ajouter un marqueur favori d'une exercice

    public function addMark(): bool
    {
        $sql = 'INSERT INTO `mark` (`user_id`, `exercise_id`) 
                VALUES (:user_id, :exercise_id);';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindValue(':exercise_id', $this->exercise_id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    // Lire tous les marqueurs favoris d'un exercice d'un utilisateur

    public function getUserMarks(int $user_id): array
    {
        $sql = 'SELECT `exercices`.* 
                FROM `mark`
                INNER JOIN `exercices` ON `mark`.`exercice_id` = `exercices`.`exercice_id`
                WHERE `mark`.`user_id` = :user_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lire tous les un marqueurs favoris pour un exercice

    public function getExerciceMarks(int $exercice_id): array
    {
        $sql = 'SELECT `users`.* 
                FROM `mark`
                INNER JOIN `users` ON `mark`.`user_id` = `users`.`user_id`
                WHERE `mark`.`exercice_id` = :exercice_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':exercice_id', $exercice_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Supprimer un marqueur favori d'un exercice

    public static function removeMark($user_id, $exercise_id): bool
    {
        $sql = 'DELETE FROM `mark` WHERE `user_id` = :user_id AND `exercise_id` = :exercise_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':exercise_id', $exercise_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lecture des exercices favoris par user 
    public static function getAllExercisesForUser($user_id): array
    {
        $sql = 'SELECT exercises.title, exercises.image, exercises.exercise_id, users.user_id FROM mark 
        JOIN users ON users.user_id = mark.user_id
        JOIN exercises ON exercises.exercise_id = mark.exercise_id
        WHERE users.user_id = :user_id';

        $stmt = Database::connect()->prepare($sql);

        // Bind du paramètre user_id
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();

        // Récupérer les exercices avec la propriété isFavorite
        return $stmt->fetchAll();
    }
}
