<?php
require_once __DIR__ . '/BaseModel.php';

// Création de la classe CalorieCalculate

class Calorie extends BaseModel
{
    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $calorie_calculate_id correspond à l'id du calcul de calories
     * @param string $lvl_act correspond au niveau d'activité
     * @param string $objective correspond à l'objectif
     * @param int $user_id correspond à l'id de l'utilisateur, c'est une clé étrangère
     */

    public function __construct(
        private ?int $calorie_calculate_id = null,
        private ?string $lvl_act = null,
        private ?string $objective = null,
        private ?int $user_id = null
    ) {
        parent::__construct();
    }

    // Les getters pour le calcul de calories

    public function getCalorieCalculateId(): int
    {
        return $this->calorie_calculate_id;
    }

    public function getLvlAct(): string
    {
        return $this->lvl_act;
    }

    public function getObjective(): string
    {
        return $this->objective;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    // Les setters pour le calcul de calories

    public function setCalorieCalculateId(int $calorie_calculate_id): self
    {
        $this->calorie_calculate_id = $calorie_calculate_id;
        return $this;
    }

    public function setLvlAct(string $lvl_act): self
    {
        $this->lvl_act = $lvl_act;
        return $this;
    }

    public function setObjective(string $objective): self
    {
        $this->objective = $objective;
        return $this;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    // Ajouter un calcul de calories

    public function addCalorieCalculate(): bool
    {
        $sql = "INSERT INTO `calorie_calculate` (`lvl_act`, `objective`, `user_id`) 
                VALUES (:lvl_act, :objective, :user_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':lvl_act', $this->lvl_act, PDO::PARAM_STR);
        $stmt->bindParam(':objective', $this->objective, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lecture de tous les calculs de calories

    public function getAllCalorieCalculates(): array
    {
        $sql = "SELECT `calorie_calculate`.*, `users`.`user_name` as `user_name`
                FROM `calorie_calculate`
                INNER JOIN `users` ON `calorie_calculate`.`user_id` = `users`.`user_id`";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Lecture d'un calcul de calories

    public function getOneCalorieCalculate(): ?array
    {
        $sql = "SELECT `calorie_calculate`.*, `users`.`user_name` as `user_name` 
                FROM `calorie_calculate`
                INNER JOIN `users` ON `calorie_calculate`.`user_id` = `users`.`user_id`
                WHERE `calorie_calculate`.`calorie_calculate_id` = :calorie_calculate_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':calorie_calculate_id', $this->calorie_calculate_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row ?: null;
    }

    // Modifier un calcul de calories

    public function updateCalorieCalculate(): bool
    {
        $sql = "UPDATE `calorie_calculate` 
                SET `lvl_act` = :lvl_act, `objective` = :objective, `user_id` = :user_id  
                WHERE `calorie_calculate_id` = :calorie_calculate_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':lvl_act', $this->lvl_act, PDO::PARAM_STR);
        $stmt->bindParam(':objective', $this->objective, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':calorie_calculate_id', $this->calorie_calculate_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer un calcul de calories

    public function deleteCalorieCalculate(): bool
    {
        $sql = "DELETE FROM `calorie_calculate` WHERE `calorie_calculate_id` = :calorie_calculate_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':calorie_calculate_id', $this->calorie_calculate_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
