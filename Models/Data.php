<?php
require_once __DIR__ . '/BaseModel.php';

// Création de la classe Data

class Data extends BaseModel
{
    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $data_id correspond à l'id des données
     * @param float $weight correspond au poids
     * @param float $height correspond à la taille
     * @param int $user_id correspond à l'id de l'utilisateur, c'est une clé étrangère
     */

    public function __construct(
        private ?int $data_id = null,
        private ?float $weight = null,
        private ?float $height = null,
        private ?int $user_id = null
    ) {
        parent::__construct();
    }

    // Les getters pour les données

    public function getDataId(): int
    {
        return $this->data_id;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    // Les setters pour les données

    public function setDataId(int $data_id): self
    {
        $this->data_id = $data_id;
        return $this;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;
        return $this;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;
        return $this;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    // Ajouter des données

    public function addData(): bool
    {
        $sql = 'INSERT INTO `data` (`weight`, `height`, `user_id`) 
                VALUES (:weight, :height, :user_id);';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':weight', $this->weight, PDO::PARAM_STR);
        $stmt->bindValue(':height', $this->height, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lecture de toutes les données pour un utilisateur

    public static function getAllData($user_id): array
{
    $sql = 'SELECT `data`.*, `users`.`user_name` as `user_name` 
            FROM `data`
            INNER JOIN `users` ON `data`.`user_id` = users.user_id
            WHERE `data`.`user_id` = :user_id';
    
    $stmt = Database::connect()->prepare($sql);  
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT); 
    $stmt->execute();  // Exécution de la requête
    return $stmt->fetchAll();  // Récupération de toutes les lignes
}

    // Lecture d'une donnée

    public static function getOneData(int $data_id): ?object
    {
        $sql = 'SELECT `data`.*, `users`.`user_name` as `user_name` 
                FROM `data`
                INNER JOIN `users` ON `data`.`user_id` = users.user_id
                WHERE `data`.`data_id` = :data_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':data_id', $data_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row ?: null;
    }

    // Lecture de l'activité selon l'user
    public static function getOneDataUser($user_id): ?object
{
    $sql = 'SELECT * FROM `data` WHERE `user_id` = :user_id ORDER BY `data_id` DESC LIMIT 1;';
    $stmt = Database::connect()->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    // Si aucune donnée n'est trouvée, renvoyer null
    if (!$result) {
        return null;
    }

    return $result;
}

    // Modifier des données

    public function updateData(): bool
    {
        $sql = 'UPDATE `data` 
                SET `weight` = :weight, `height` = :height, `user_id` = :user_id  
                WHERE `data_id` = :data_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':weight', $this->weight, PDO::PARAM_STR);
        $stmt->bindValue(':height', $this->height, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindValue(':data_id', $this->data_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer des données de l'id sélectionné

    public static function deleteData(int $data_id): bool
    {
        $sql = 'DELETE FROM `data` WHERE `data_id` = :data_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':data_id', $data_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer toutes les données d'un utilisateur
    public static function deleteDataByUserId($user_id): bool 
    {
        $sql = 'DELETE FROM `data` WHERE `user_id` = :user_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        return $stmt->execute();
}
}
?>
