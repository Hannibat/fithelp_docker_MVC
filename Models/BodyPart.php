<?php
require_once __DIR__ . '/BaseModel.php';

// Création de la classe BodyPart

class BodyPart extends BaseModel
{
    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $body_part_id correspond à l'id de la partie du corps
     * @param string $body_part correspond au nom de la partie du corps
     * @param int $body_part_parent_id correspond à l'id de la partie du corps parent, c'est une clé étrangère
     */

    public function __construct(
        private ?int $body_part_id = null,
        private ?string $body_part = null,
        private ?int $body_part_parent_id = null,
    ) {
        parent::__construct();
    }

    // Les getters pour la partie du corps

    public function getBodyPartId(): int
    {
        return $this->body_part_id;
    }

    public function getBodyPart(): string
    {
        return $this->body_part;
    }

    public function getBodyPartParentId(): ?int
    {
        return $this->body_part_parent_id;
    }

    // Les setters pour la partie du corps

    public function setBodyPartId(int $body_part_id): self
    {
        $this->body_part_id = $body_part_id;
        return $this;
    }

    public function setBodyPart(string $body_part): self
    {
        $this->body_part = $body_part;
        return $this;
    }

    public function setBodyPartParentId(?int $body_part_parent_id): self
    {
        $this->body_part_parent_id = $body_part_parent_id;
        return $this;
    }

    // Ajouter une partie du corps

    public function addBodyPart(): bool
    {
        $sql = "INSERT INTO `body_parts` (`body_part`, `body_part_parent_id`) 
                VALUES (:body_part, :body_part_parent_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':body_part', $this->body_part, PDO::PARAM_STR);
        $stmt->bindParam(':body_part_parent_id', $this->body_part_parent_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lecture de toutes les parties du corps

    public function getAllBodyParts(): array
    {
        $sql = "SELECT * FROM `body_parts`";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Lecture des sous-parties d'une partie du corps

    // public function getSubBodyParts(int $body_part_id): array
    // {
    //     $sql = "SELECT * FROM `body_parts` WHERE `body_part_parent_id` = :body_part_id";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bindParam(':body_part_id', $body_part_id, PDO::PARAM_INT);
    //     $stmt->execute();
    //     return $stmt->fetchAll();
    // }

    // Lecture d'une partie du corps

    public function getOneBodyPart(): object
    {
        $sql = "SELECT * FROM `body_parts` WHERE `body_part_id` = :body_part_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':body_part_id', $this->body_part_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Modifier une partie du corps

    public function updateBodyPart(): bool
    {
        $sql = "UPDATE `body_parts` 
                SET `body_part` = :body_part, `body_part_parent_id` = :body_part_parent_id 
                WHERE `body_part_id` = :body_part_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':body_part', $this->body_part, PDO::PARAM_STR);
        $stmt->bindParam(':body_part_parent_id', $this->body_part_parent_id, PDO::PARAM_INT);
        $stmt->bindParam(':body_part_id', $this->body_part_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer une partie du corps

    public function deleteBodyPart(): bool
    {
        $sql = "DELETE FROM `body_parts` WHERE `body_part_id` = :body_part_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':body_part_id', $this->body_part_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
