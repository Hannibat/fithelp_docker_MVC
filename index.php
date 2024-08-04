<?php
// Import des fichiers utilisés par les modèles
require_once './config/database.php';
require_once './Models/Database.php';
require_once './Models/BaseModel.php';
require_once './Models/BodyPart.php';
require_once './Models/Exercise.php';
require_once './Models/User.php';


// helpers
require_once './helpers/http_helper.php';

// démarrage session
session_start();

// Import des contrôleurs

$page = $_GET['page'] ?? '';

$page = filter_var($page, FILTER_SANITIZE_SPECIAL_CHARS);

$pathAdmin = match ($page) {
    '','showCase/home' => 'showCase/home',

    'exercises/add-exercise' => 'dashboard/exercises/add-exercise',
    'exercises/list-exercises' => 'dashboard/exercises/list-exercises',
    'exercises/update-exercise' => 'dashboard/exercises/update-exercise',
    'exercises/delete-exercise' => 'dashboard/exercises/delete-exercise',

    'users/signup' => 'showCase/users/signup',
    'users/signin' => 'showCase/users/signin',
    'users/signout' => 'showCase/users/signout',

    'showcase/profil' => 'showCase/profil',

    default => '404'
};

$pathUser = match ($page) {
    '','showCase/home' => 'showCase/home',

    'users/signup' => 'showCase/users/signup',
    'users/signin' => 'showCase/users/signin',
    'users/signout' => 'showCase/users/signout',
    
    'showcase/profil' => 'showCase/profil',

    'exercises/list-exercises' => 'dashboard/exercises/list-exercises',
    'users/detail-ex' => 'showCase/users/detail-ex',

    default => '404'
};

$pathPublic = match ($page) {
    '','showCase/home' => 'showCase/home',

    'users/signup' => 'showCase/users/signup',
    'users/signin' => 'showCase/users/signin',
    'users/signout' => 'showCase/users/signout',

    default => '404'
};

if (User::isAdmin()) {
    $path = $pathAdmin;
} elseif (User::isUser()) {
    $path = $pathUser;
} else {
    $path = $pathPublic;
}

// Router
require_once './Controllers/' . $path . '-ctrl.php';