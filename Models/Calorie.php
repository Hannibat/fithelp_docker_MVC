<?php
require_once __DIR__ . '/BaseModel.php';

// Création de la classe CalorieCalculate

class Calorie extends BaseModel
{
    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $calorie_calculate_id correspond à l'id du calcul de calories
     * @param float $lvl_act correspond au niveau d'activité
     * @param int $user_id correspond à l'id de l'utilisateur, c'est une clé étrangère
     */

    public function __construct(
        private ?int $calorie_calculate_id = null,
        private ?float $lvl_act = null,
        private ?int $user_id = null
    ) {
        parent::__construct();
    }

    // Les getters pour le calcul de calories

    public function getCalorieCalculateId(): int
    {
        return $this->calorie_calculate_id;
    }

    public function getLvlAct(): float
    {
        return $this->lvl_act;
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

    public function setLvlAct(float $lvl_act): self
    {
        $this->lvl_act = $lvl_act;
        return $this;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    // Ajouter un calcul de calories

    public function addLvlAct(): ?bool
{
    $sql = 'INSERT INTO `calorie_calculate` (`lvl_act`, `user_id`) 
            VALUES (:lvl_act, :user_id);';
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':lvl_act', $this->lvl_act, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
    return $stmt->execute();
}

    // Lecture de tous les calculs de calories

    public static function getAllLvlActs(): array
    {
        $sql = 'SELECT `calorie_calculate`.*, `users`.`user_name` as `user_name`
                FROM `calorie_calculate`
                INNER JOIN `users` ON `calorie_calculate`.`user_id` = `users`.`user_id`;';
        $stmt = Database::connect()->query($sql);
        return $stmt->fetchAll();
    }

    // Lecture d'un calcul de calories

    public static function getOneLvlAct($calorie_calculate_id): ?object
    {
        $sql = 'SELECT `calorie_calculate`.*, `users`.`user_name` as `user_name` 
                FROM `calorie_calculate`
                INNER JOIN `users` ON `calorie_calculate`.`user_id` = `users`.`user_id`
                WHERE `calorie_calculate`.`calorie_calculate_id` = :calorie_calculate_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':calorie_calculate_id', $calorie_calculate_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Lecture de la dernière valeur de l'activité transmise selon l'user
    public static function getOneLvlActUser($user_id) {
        $sql = 'SELECT * FROM `calorie_calculate` WHERE `user_id` = :user_id ORDER BY `calorie_calculate_id` DESC LIMIT 1;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Modifier un calcul de calories

    public function updateLvlAct(): bool
    {
        $sql = 'UPDATE `calorie_calculate` 
                SET `lvl_act` = :lvl_act, `user_id` = :user_id  
                WHERE `calorie_calculate_id` = :calorie_calculate_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':lvl_act', $this->lvl_act, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindValue(':calorie_calculate_id', $this->calorie_calculate_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer un calcul de calories

    public static function deleteLvlAct($calorie_calculate_id): bool
    {
        $sql = 'DELETE FROM `calorie_calculate` WHERE `calorie_calculate_id` = :calorie_calculate_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':calorie_calculate_id', $calorie_calculate_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer l'activité selon user
    public static function deleteLvlActByUserId($user_id): bool
    {
        $sql = 'DELETE FROM `calorie_calculate` WHERE `user_id` = :user_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
