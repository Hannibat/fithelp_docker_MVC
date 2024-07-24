<?php
require_once __DIR__ . '/BaseModel.php';

// Création de la classe Program

class Program extends BaseModel
{
    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $program_id correspond à l'id du programme
     * @param string $name correspond au nom du programme
     * @param string $description correspond à la description du programme
     * @param int $duration correspond à la durée du programme
     */

    public function __construct(
        private ?int $program_id = null,
        private ?string $name = null,
        private ?string $description = null,
        private ?int $duration = null
    ) {
        parent::__construct();
    }

    // Les getters pour le programme

    public function getProgramId(): int
    {
        return $this->program_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    // Les setters pour le programme

    public function setProgramId(int $program_id): self
    {
        $this->program_id = $program_id;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    // Ajouter un programme

    public function addProgram(): bool
    {
        $sql = "INSERT INTO `programs` (`name`, `description`, `duration`) 
                VALUES (:name, :description, :duration)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindParam(':duration', $this->duration, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lecture de tous les programmes

    public function getAllPrograms(): array
    {
        $sql = "SELECT * FROM `programs`";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lecture d'un programme

    public function getOneProgram(): ?array
    {
        $sql = "SELECT * FROM `programs` WHERE `program_id` = :program_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':program_id', $this->program_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    // Modifier un programme

    public function updateProgram(): bool
    {
        $sql = "UPDATE `programs` 
                SET `name` = :name, `description` = :description, `duration` = :duration  
                WHERE `program_id` = :program_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindParam(':duration', $this->duration, PDO::PARAM_INT);
        $stmt->bindParam(':program_id', $this->program_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer un programme

    public function deleteProgram(): bool
    {
        $sql = "DELETE FROM `programs` WHERE `program_id` = :program_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':program_id', $this->program_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
