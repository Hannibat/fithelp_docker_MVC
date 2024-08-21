<?php
require_once __DIR__ . '/BaseModel.php';
require_once __DIR__ . '/BodyPart.php';

// Création de la classe Exercice

class Exercise extends BaseModel
{
    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $exercise_id correspond à l'id de l'exercice
     * @param string $title correspond au titre de l'exercice
     * @param string $intro correspond à l'introduction de l'exercice
     * @param string $position correspond à la description de la position de l'exercice
     * @param string $movement correspond à la description du mouvement de l'exercice
     * @param string $image correspond à l'image de l'exercice
     * @param string $targeted_muscles correspond aux muscles ciblés par l'exercice
     * @param int $body_part_id correspond à l'id de la partie du corps, c'est une clé étrangère
     */
    

    public function __construct(
        private ?int $exercise_id = null,
        private ?string $title = null,
        private ?string $intro = null,
        private ?string $position = null,
        private ?string $movement = null,
        private ?string $image = null,
        private ?string $targeted_muscles = null,
        private ?int $body_part_id = null,
    ) {
        parent::__construct();
    }

    // Les getters pour l'exercice

    public function getExerciseId(): int
    {
        return $this->exercise_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getIntro(): string
    {
        return $this->intro;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getMovement(): string
    {
        return $this->movement;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getTargetedMuscles(): string
    {
        return $this->targeted_muscles;
    }

    public function getBodyPartId(): int
    {
        return $this->body_part_id;
    }

    // Les setters pour l'exercice

    public function setExerciseId(int $exercise_id): self
    {
        $this->exercise_id = $exercise_id;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setIntro(string $intro): self
    {
        $this->intro = $intro;
        return $this;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;
        return $this;
    }

    public function setMovement(string $movement): self
    {
        $this->movement = $movement;
        return $this;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function setTargetedMuscles(string $targeted_muscles): self
    {
        $this->targeted_muscles = $targeted_muscles;
        return $this;
    }

    public function setBodyPartId(int $body_part_id): self
    {
        $this->body_part_id = $body_part_id;
        return $this;
    }

    // Ajouter un exercice

    public function addExercise(): bool
    {
        $sql = 'INSERT INTO `exercises` (`title`, `intro`, `position`, `movement`, `image`, `targeted_muscles`, `body_part_id`) 
                VALUES (:title, :intro, :position, :movement, :image, :targeted_muscles, :body_part_id);';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':intro', $this->intro, PDO::PARAM_STR);
        $stmt->bindValue(':position', $this->position, PDO::PARAM_STR);
        $stmt->bindValue(':movement', $this->movement, PDO::PARAM_STR);
        $stmt->bindValue(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindValue(':targeted_muscles', $this->targeted_muscles, PDO::PARAM_STR);
        $stmt->bindValue(':body_part_id', $this->body_part_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lecture de tous les exercices

    public static function getAllExercises(): array
    {
        $sql = 'SELECT `exercises`.*, `body_parts`.`body_part` as `body_part` 
            FROM `exercises`
            INNER JOIN `body_parts` ON `exercises`.`body_part_id` = `body_parts`.`body_part_id`;';
        $stmt = Database::connect()->query($sql);
        return $stmt->fetchAll();
    }

    // Lecture des exercices d'une seule partie du corps

    public static function getExercisesByBodyPart(int $body_part_id): array
    {
        $sql = 'SELECT `exercises`.*, `body_parts`.`body_part` as `body_part` 
            FROM `exercises`
            INNER JOIN `body_parts` ON `exercises`.`body_part_id` = `body_parts`.`body_part_id`
            WHERE `exercises`.`body_part_id` = :body_part_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':body_part_id', $body_part_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lecture d'un exercice

    public static function getOneExercise($exercise_id): object
    {
        $sql = 'SELECT `exercises`.*, `body_parts`.`body_part` as `body_part` 
        FROM `exercises`
        INNER JOIN `body_parts` ON `exercises`.`body_part_id` = `body_parts`.`body_part_id`
        WHERE `exercise_id` = :exercise_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':exercise_id', $exercise_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Modifier un exercice
    public function updateExercise(): bool
    {
        $sql = 'UPDATE `exercises` 
                SET `title` = :title, `intro` = :intro, `position` = :position, `movement` = :movement, 
                `image` = :image, `targeted_muscles` = :targeted_muscles, `body_part_id` = :body_part_id  
                WHERE `exercise_id` = :exercise_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':intro', $this->intro, PDO::PARAM_STR);
        $stmt->bindValue(':position', $this->position, PDO::PARAM_STR);
        $stmt->bindValue(':movement', $this->movement, PDO::PARAM_STR);
        $stmt->bindValue(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindValue(':targeted_muscles', $this->targeted_muscles, PDO::PARAM_STR);
        $stmt->bindValue(':body_part_id', $this->body_part_id, PDO::PARAM_INT);
        $stmt->bindValue(':exercise_id', $this->exercise_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer un exercice
    public static function deleteExercise($exercise_id): bool
    {
        $sql = 'DELETE FROM `exercises` WHERE `exercise_id` = :exercise_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':exercise_id', $exercise_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer l'image d'un exercice
    public function removeImage(int $exercise_id): bool
    {
        $sql = 'UPDATE `exercises` 
                SET `image` = NULL 
                WHERE `exercise_id` = :exercise_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':exercise_id', $exercise_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Ajouter ou mettre à jour l'image d'un exercice
    public function addImage(): bool
    {
        $sql = 'UPDATE `exercises` 
                SET `image` = :image 
                WHERE `exercise_id` = :exercise_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindValue(':exercise_id', $this->exercise_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

?>
