<?php
require_once __DIR__ . '/BaseModel.php';
require_once __DIR__ . '/BodyPart.php';

// Création de la classe Exercice

class Exercice extends BaseModel
{
    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $exercice_id correspond à l'id de l'exercice
     * @param string $title correspond au titre de l'exercice
     * @param string $intro correspond à l'introduction de l'exercice
     * @param string $position correspond à la description de la position de l'exercice
     * @param string $movement correspond à la description du mouvement de l'exercice
     * @param string $image correspond à l'image de l'exercice
     * @param string $targeted_muscles correspond aux muscles ciblés par l'exercice
     * @param int $body_part_id correspond à l'id de la partie du corps, c'est une clé étrangère
     */

    public function __construct(
        private ?int $exercice_id = null,
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

    public function getExerciceId(): int
    {
        return $this->exercice_id;
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

    public function setExerciceId(int $exercice_id): self
    {
        $this->exercice_id = $exercice_id;
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

    public function addExercice(): bool
    {
        $sql = "INSERT INTO `exercices` (`title`, `intro`, `position`, `movement`, `image`, `targeted_muscles`, `body_part_id`) 
                VALUES (:title, :intro, :position, :movement, :image, :targeted_muscles, :body_part_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindParam(':intro', $this->intro, PDO::PARAM_STR);
        $stmt->bindParam(':position', $this->position, PDO::PARAM_STR);
        $stmt->bindParam(':movement', $this->movement, PDO::PARAM_STR);
        $stmt->bindParam(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindParam(':targeted_muscles', $this->targeted_muscles, PDO::PARAM_STR);
        $stmt->bindParam(':body_part_id', $this->body_part_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lecture de tous les exercices

    public function getAllExercices(): array
    {
        $sql = "SELECT `exercices`.*, `body_parts`.`body_part` as `body_part` 
            FROM `exercices`
            INNER JOIN `body_parts` ON `exercices`.`body_part_id` = `body_parts`.`body_part_id`";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lecture des exercices d'une seule partie du corps

    public function getExercicesByBodyPart(int $body_part_id): array
    {
        $sql = "SELECT `exercices`.*, `body_parts`.`body_part` as `body_part` 
            FROM `exercices`
            INNER JOIN `body_parts` ON `exercices`.`body_part_id` = `body_parts`.`body_part_id`
            WHERE `exercices`.`body_part_id` = :body_part_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':body_part_id', $body_part_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lecture d'un exercice

    public function getOneExercice(): ?array
    {
        $sql = "SELECT `exercices`.*, `body_parts`.`body_part` as `body_part` 
        FROM `exercices`
        INNER JOIN `body_parts` ON `exercices`.`body_part_id` = `body_parts`.`body_part_id`
        WHERE `exercice_id` = :exercice_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':exercice_id', $this->exercice_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row ?: null;
    }

    // Modifier un exercice

    public function updateExercice(): bool
    {
        $sql = "UPDATE `exercices` 
                SET `title` = :title, `intro` = :intro, `position` = :position, `movement` = :movement, `image` = :image, `targeted_muscles` = :targeted_muscles, `body_part_id` = :body_part_id  
                WHERE `exercice_id` = :exercice_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindParam(':intro', $this->intro, PDO::PARAM_STR);
        $stmt->bindParam(':position', $this->position, PDO::PARAM_STR);
        $stmt->bindParam(':movement', $this->movement, PDO::PARAM_STR);
        $stmt->bindParam(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindParam(':targeted_muscles', $this->targeted_muscles, PDO::PARAM_STR);
        $stmt->bindParam(':body_part_id', $this->body_part_id, PDO::PARAM_INT);
        $stmt->bindParam(':exercice_id', $this->exercice_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer un exercice

    public function deleteExercice(): bool
    {
        $sql = "DELETE FROM `exercices` WHERE `exercice_id` = :exercice_id;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':exercice_id', $this->exercice_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer l'image d'un exercice
    public function removeImage(int $exercice_id): bool
    {
        $sql = "UPDATE `exercices` 
                SET `image` = NULL 
                WHERE `exercice_id` = :exercice_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':exercice_id', $exercice_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Ajouter ou mettre à jour l'image d'un exercice
    public function addImage(): bool
    {
        $sql = "UPDATE `exercices` 
                SET `image` = :image 
                WHERE `exercice_id` = :exercice_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindParam(':exercice_id', $this->exercice_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

?>
