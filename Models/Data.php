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

    // Lecture de toutes les données

    public function getAllData(): array
    {
        $sql = 'SELECT `data`.*, `users`.`user_name` as `user_name` 
                FROM `data`
                INNER JOIN `users` ON `data`.`user_id` = users.user_id;';
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Lecture d'une donnée

    public function getOneData(): ?array
    {
        $sql = 'SELECT `data`.*, `users`.`user_name` as `user_name` 
                FROM `data`
                INNER JOIN `users` ON `data`.`user_id` = users.user_id
                WHERE `data`.`data_id` = :data_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':data_id', $this->data_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row ?: null;
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

    // Supprimer des données

    public function deleteData(): bool
    {
        $sql = 'DELETE FROM `data` WHERE `data_id` = :data_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':data_id', $this->data_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
