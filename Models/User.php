<?php
require_once __DIR__ . '/BaseModel.php';

// Création de la classe User

class User extends BaseModel
{
    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * 
     * @param int $user_id correspond à l'id de l'utilisateur
     * @param string $user_name correspond au nom de l'utilisateur
     * @param string $mail correspond à l'email de l'utilisateur
     * @param string $password correspond au mot de passe de l'utilisateur
     * @param string $birthdate correspond à la date de naissance de l'utilisateur
     * @param bool $gender correspond au sexe de l'utilisateur
     * @param int $role correspond au rôle de l'utilisateur
     */

    public function __construct(
        private ?int $user_id = null,
        private ?string $user_name = null,
        private ?string $mail = null,
        private ?string $password = null,
        private ?string $birthdate = null,
        private ?bool $gender = null,
        private ?int $role = null
    ) {
        parent::__construct();
    }

    // Les getters pour l'utilisateur

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getUserName(): string
    {
        return $this->user_name;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getBirthdate(): string
    {
        return $this->birthdate;
    }

    public function getGender(): bool
    {
        return $this->gender;
    }

    public function getRole(): int
    {
        return $this->role;
    }

    // Les setters pour l'utilisateur

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function setUserName(string $user_name): self
    {
        $this->user_name = $user_name;
        return $this;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setBirthdate(string $birthdate): self
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    public function setGender(bool $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;
        return $this;
    }

    // Ajouter un utilisateur

    public function addUser(): bool
    {
        $sql = "INSERT INTO `users` (`user_name`, `mail`, `password`, `birthdate`, `gender`, `role`) 
                VALUES (:user_name, :mail, :password, :birthdate, :gender, :role)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_name', $this->user_name, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $this->mail, PDO::PARAM_STR);
        $stmt->bindParam(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindParam(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $this->gender, PDO::PARAM_BOOL);
        $stmt->bindParam(':role', $this->role, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lecture de tous les utilisateurs

    public function getAllUsers(): array
    {
        $sql = "SELECT * FROM `users`";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Lecture d'un utilisateur

    public function getOneUser(): ?array
    {
        $sql = "SELECT * FROM `users` WHERE `user_id` = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row ?: null;
    }

    // Modifier un utilisateur

    public function updateUser(): bool
    {
        $sql = "UPDATE `users` 
                SET `user_name` = :user_name, `mail` = :mail, `password` = :password, `birthdate` = :birthdate, `gender` = :gender, `role` = :role
                WHERE `user_id` = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_name', $this->user_name, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $this->mail, PDO::PARAM_STR);
        $stmt->bindParam(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindParam(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $this->gender, PDO::PARAM_BOOL);
        $stmt->bindParam(':role', $this->role, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer un utilisateur

    public function deleteUser(): bool
    {
        $sql = "DELETE FROM `users` WHERE `user_id` = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
?>
