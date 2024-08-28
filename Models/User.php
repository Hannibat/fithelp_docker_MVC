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
     * @param string $email correspond à l'email de l'utilisateur
     * @param string $password correspond au mot de passe de l'utilisateur
     * @param string $birthdate correspond à la date de naissance de l'utilisateur
     * @param bool $gender correspond au sexe de l'utilisateur
     * @param int $role correspond au rôle de l'utilisateur
     * @param string $inscription_date date inscription de l'utilisateur
     */

    public function __construct(
        private ?int $user_id = null,
        private ?string $user_name = null,
        private ?string $email = null,
        private ?string $password = null,
        private ?string $birthdate = null,
        private ?bool $gender = null,
        private ?int $role = null,
        private ?string $inscription_date = null
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

    public function getEmail(): string
    {
        return $this->email;
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

    public function setEmail(string $email): self
    {
        $this->email = $email;
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
        $sql = 'INSERT INTO `users` (`user_name`, `email`, `password`, `birthdate`, `gender`, `role`) 
                VALUES (:user_name, :email, :password, :birthdate, :gender, :role);';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_name', $this->user_name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $stmt->bindValue(':gender', $this->gender, PDO::PARAM_BOOL);
        $stmt->bindValue(':role', $this->role, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lecture de tous les utilisateurs

    public static function getAllUsers(): array
    {
        $sql = 'SELECT * FROM `users` WHERE `deleted_at` IS NULL;';
        $stmt = Database::connect()->query($sql);
        return $stmt->fetchAll();
    }

    // Lecture d'un utilisateur

    public static function getOneUser($user_id): ?object
    {
        $sql = 'SELECT * FROM `users` WHERE `user_id` = :user_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Modifier un utilisateur

    public function updateUser(): bool
    {
        $sql = 'UPDATE `users` 
                SET `user_name` = :user_name, `email` = :email, `password` = :password, `birthdate` = :birthdate, `gender` = :gender, `role` = :role
                WHERE `user_id` = :user_id;';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_name', $this->user_name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $stmt->bindValue(':gender', $this->gender, PDO::PARAM_BOOL);
        $stmt->bindValue(':role', $this->role, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer un utilisateur

    public static function deleteUser($user_id): bool
    {
        $sql = 'UPDATE `users` SET `deleted_at` = NOW() WHERE `user_id` = :user_id;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Vérifier si l'email de l'utilisateur inscrit existe déjà

    public static function isMailExist(string $email) : bool
    {
        $sql = 'SELECT `email` FROM `users` WHERE `email` = :email;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch() ? true : false;
    }

    // Sélectionner l'utilisateur avec son email

    public static function getUserByEmail(string $email): object|false{
        $sql = 'SELECT * FROM `users` WHERE `email` = :email;';
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Savoir si il est admin ou non

    public static function isAdmin(): bool{
        if(isset($_SESSION['user']) && $_SESSION['user']->role === 1){
            return true;
        } else {
            return false;
        } 
    }

    // Savoir si il est user ou non

    public static function isUser(): bool{
        if(isset($_SESSION['user']) && $_SESSION['user']->role === null){
            return true;
        } else {
            return false;
        } 
    }
}
?>
