<?php

$title = 'Inscription';

$email = null;
$password = null;
$confirmPassword = null;
$userName = null;
$birthdate = null;
$gender = null;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        // extract($_POST);
        // $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if(!$email){
            $errors['email'] = 'Email invalide';
        }

        $password = filter_input(INPUT_POST, 'password');
        if(!$password){
            $errors['password'] = 'Mot de passe non conforme';
        }

        $confirmPassword = filter_input(INPUT_POST, 'confirmPassword');
        if(!$confirmPassword){
            $errors['password'] = 'Mot de passe non conforme';
        }

        if($password !== $confirmPassword){
            $errors['password'] = 'Les mots de passe sont différents ';
        }

        if(User::isMailExist($email)){
            $errors['email'] = 'L\'email existe déjà';
        }

        $userName = filter_input(INPUT_POST, 'user_name');
        if(!$userName){
            $errors['user_name'] = 'Nom utilisateur non valide';
        }
        
        $birthdate = filter_input(INPUT_POST, 'birthdate');
        if(!$birthdate){
            $errors['birthdate'] = 'Année de naissance non valide';
        }
        
        $gender = filter_input(INPUT_POST, 'gender');
        if($gender === null){
            $errors['gender'] = 'Genre non valide';
        }
        
        if(empty($errors)){
            $password  = password_hash($password, PASSWORD_DEFAULT);

            // Instanciation de User
            $user = new User(user_name: $userName, email: $email, password: $password, birthdate: $birthdate, gender: $gender);
            // Ajout du user
            $saved = $user->addUser();
            $user = $user->getUserByEmail($email);
            if ($saved) {
                // Authentifier l'utilisateur
                $_SESSION['user'] = $user;
                
                // Rediriger vers la page d'accueil
                
                addFlash('success', 'Inscription réussie et connexion établie!');
                redirectToRoute('?page=showCase/home');
            } else {
                throw new Exception('Erreur lors de l\'enregistrement de l\'utilisateur.');
            }
        }

    } catch (\Exception $e) {
        echo sprintf('Problème avec l\'inscription %s', $e->getMessage());
    }

}

renderView('showCase/users/signup', compact('title', 'errors'));