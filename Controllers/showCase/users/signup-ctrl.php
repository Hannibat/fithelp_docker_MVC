<?php

$title = 'Inscription';

$email = null;
$password = null;
$confirmPassword = null;
$userName = null;
$birthdate = null;
$gender = null;
$error = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {

        // Récupérer le nom de l'utilisateur
        $userName = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($userName)) {
            $error['userName'] = "Le nom est obligatoire";
        } elseif (strlen($userName) < 2) {
            $error['userName'] = "Le nom est trop court, 2 caractères minimum";
        } elseif (strlen($userName) > 30) {
            $error['userName'] = "Le nom est trop long, 30 caractères maximum";
        } else {
            $userNameRegex = filter_var($userName, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_NAME . '/')));
            if (!$userNameRegex) {
                $error['userName'] = "Le nom ne doit contenir que des lettres et certains accents.";
            }
        }
        

        // Récupérer adresse mail et le nettoyer
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        if (empty($email)) {
            $error['email'] = "L'adresse mail est obligatoire";
        } else {
            $emailValidate = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$emailValidate) {
                $error['email'] = "L'adresse email n'est pas au bon format";
            } elseif (User::isMailExist($emailValidate)) {
                $error['email'] = "L'email existe déjà";
            }
        }

        // Récupérer le mot de passe
        $password = filter_input(INPUT_POST, 'password');
        if (empty($password)) {
            $error["password"] = "Le mot de passe est obligatoire";
        } else {
            $passwordRegex = filter_var($password, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_PASSWORD . '/')));
            if (!$passwordRegex) {
                $error['password'] = "Le format du mot de passe est incorrect";
            }
        }

        // Vérifier le mot de passe
        $confirmPassword = filter_input(INPUT_POST, 'confirmPassword');
        if (empty($confirmPassword)) {
            $error["confirmPassword"] = "Veuillez confirmer le mot de passe";
        } elseif ($password !== $confirmPassword) {
            $error['confirmPassword'] = "Les deux mots de passe ne sont pas identiques";
        }

        // Récupérer la date de naissance
        $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($birthdate)) {
            $error['birthdate'] = "La date de naissance est obligatoire";
        } else {
            $ddn = DateTime::createFromFormat('Y-m-d', $birthdate);
            if ($ddn > new DateTime()) {
                $error['birthdate'] = "La date sélectionnée est dans le futur";
            } else {
                $birthdateRegex = filter_var($birthdate, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_BIRTHDATE . '/')));
                if (!$birthdateRegex) {
                    $error['birthdate'] = "Le format de la date est incorrect";
                }
            }
        }

        // Récupérer la civilité
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($gender)) {
            $error["gender"] = "Veuillez renseigner une civilité";
        } elseif ($gender !== "M" && $gender !== "Mme") {
            $error["civilityGender"] = "Veuillez renseigner Monsieur ou Madame";
        }

        if (empty($error)) {
            $password  = password_hash($passwordRegex, PASSWORD_DEFAULT);

            // Instanciation de User
            $user = new User(user_name: $userNameRegex, email: $emailValidate, password: $password, birthdate: $birthdateRegex, gender: $gender);
            // Ajout du user
            $saved = $user->addUser();
            $user = $user->getUserByEmail($emailValidate);
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

renderView('showCase/users/signup', compact('title', 'error'));
