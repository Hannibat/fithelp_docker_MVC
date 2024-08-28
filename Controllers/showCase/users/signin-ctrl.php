<?php

$title = 'Connexion';

$email = null;
$password = null;
$error = [] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if(!User::isMailExist($email)){
            throw new Exception('Ce compte n\'existe pas', 1);
        }

        if(empty($errors)){
            $user = User::getUserByEmail($email);
            $verified = password_verify($password, $user->password);
            if(!$verified){
                throw new Exception('Erreur de login', 2);
            }
        }

        if($user->deleted_at !== null) {
            $error['user'] = "Votre compte n'est plus valide, il a été supprimé";
        } else {
            unset($user->password);
            $_SESSION['user'] = $user;
            redirectToRoute('');
            die;
        }

    } catch (Exception $ex) {
        $error['login'] = $ex->getMessage();
    }
}

$title = "Connexion";
renderView('showCase/users/signin', compact('title', 'error'));

