<?php
require_once __DIR__ . '/BaseModel.php';

// Création de la classe ProgramEx

class ProgramEx extends BaseModel
{
    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $exercice_id correspond à l'id de l'exercice
     * @param int $program_id correspond à l'id du programme
     */

    public function __construct(
        private ?int $exercice_id = null,
        private ?int $program_id = null
    ) {
        parent::__construct();
    }

    // Les getters pour la table ProgramEx

    public function getExerciceId(): int
    {
        return $this->exercice_id;
    }

    public function getProgramId(): int
    {
        return $this->program_id;
    }

    // Les setters pour la table ProgramEx

    public function setExerciceId(int $exercice_id): self
    {
        $this->exercice_id = $exercice_id;
        return $this;
    }

    public function setProgramId(int $program_id): self
    {
        $this->program_id = $program_id;
        return $this;
    }

    // Ajouter une relation exercice-programme

    public function addProgramEx(): bool
    {
        $sql = "INSERT INTO `program_ex` (`exercice_id`, `program_id`) 
                VALUES (:exercice_id, :program_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':exercice_id', $this->exercice_id, PDO::PARAM_INT);
        $stmt->bindParam(':program_id', $this->program_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    
    // Lire tous les exercices d'un programme
    
    public function getExercisesByProgram(int $program_id): array
    {
        $sql = "SELECT `exercices`.* 
                FROM `program_ex`
                INNER JOIN `exercices` ON `program_ex`.`exercice_id` = `exercices`.`exercice_id`
                WHERE `program_ex`.`program_id` = :program_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':program_id', $program_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Lire tous les programmes d'un exercice
    
    public function getProgramsByExercise(int $exercice_id): array
    {
        $sql = "SELECT `programs`.* 
                FROM `program_ex`
                INNER JOIN `programs` ON `program_ex`.`program_id` = `programs`.`program_id`
                WHERE `program_ex`.`exercice_id` = :exercice_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':exercice_id', $exercice_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Supprimer une relation exercice-programme

    public function removeProgramEx(): bool
    {
        $sql = "DELETE FROM `program_ex` WHERE `exercice_id` = :exercice_id AND `program_id` = :program_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':exercice_id', $this->exercice_id, PDO::PARAM_INT);
        $stmt->bindParam(':program_id', $this->program_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
