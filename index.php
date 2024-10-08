<?php
// Import des fichiers utilisés par les modèles
require_once './config/config.php';
require_once './config/database.php';
require_once './Models/Database.php';
require_once './Models/BaseModel.php';
require_once './Models/BodyPart.php';
require_once './Models/Exercise.php';
require_once './Models/User.php';
require_once './Models/Data.php';
require_once './Models/Calorie.php';
require_once './Models/Article.php';
require_once './Models/CategoryArticle.php';
require_once './Models/Mark.php';


// helpers
require_once './helpers/http_helper.php';

// démarrage session
session_start();

// Import des contrôleurs

$page = $_GET['page'] ?? '';
//var_dump($page);

$page = filter_var($page, FILTER_SANITIZE_SPECIAL_CHARS);
//var_dump($page);
//die;
$pathAdmin = match ($page) {
    '','showCase/home' => 'showCase/home',
    'showCase/presentation' => 'showCase/presentation',

    'exercises/add-exercise' => 'dashboard/exercises/add-exercise',
    'exercises/list-exercises' => 'dashboard/exercises/list-exercises',
    'exercises/update-exercise' => 'dashboard/exercises/update-exercise',
    'exercises/delete-exercise' => 'dashboard/exercises/delete-exercise',

    'articles/add-article' => 'dashboard/articles/add-article',
    'articles/list-articles' => 'dashboard/articles/list-articles',
    'articles/delete-article' => 'dashboard/articles/delete-article',
    'articles/update-article' => 'dashboard/articles/update-article',

    'categories-article/add-category-article' => 'dashboard/categories-article/add-category-article',
    'categories-article/list-categories-article' => 'dashboard/categories-article/list-categories-article',
    'categories-article/delete-category-article' => 'dashboard/categories-article/delete-category-article',
    'categories-article/update-category-article' => 'dashboard/categories-article/update-category-article',

    'users/delete-user' => 'dashboard/users/delete-user',

    'users/list-users' => 'dashboard/users/list-users',

    'users/signup' => 'showCase/users/signup',
    'users/signin' => 'showCase/users/signin',
    'users/signout' => 'showCase/users/signout',
    'users/detail-article' => 'showCase/users/detail-article',
    'users/detail-exercise' => 'showCase/users/detail-exercise',

    'users/update-favorite' => 'showCase/users/update-favorite',


    'users/profil' => 'showCase/users/profil',

    default => '404'
};

$pathUser = match ($page) {
    '','showCase/home' => 'showCase/home',
    'showCase/presentation' => 'showCase/presentation',

    'users/signup' => 'showCase/users/signup',
    'users/signin' => 'showCase/users/signin',
    'users/signout' => 'showCase/users/signout',
    
    'users/profil' => 'showCase/users/profil',
    'users/detail-article' => 'showCase/users/detail-article',
    'users/detail-exercise' => 'showCase/users/detail-exercise',

    'articles/list-articles' => 'dashboard/articles/list-articles',

    'users/update-favorite' => 'showCase/users/update-favorite',

    'exercises/list-exercises' => 'dashboard/exercises/list-exercises',

    default => '404'
};

$pathPublic = match ($page) {
    '','showCase/home' => 'showCase/home',
    'showCase/presentation' => 'showCase/presentation',

    'users/signup' => 'showCase/users/signup',
    'users/signin' => 'showCase/users/signin',
    'users/detail-article' => 'showCase/users/detail-article',

    'articles/list-articles' => 'dashboard/articles/list-articles',

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