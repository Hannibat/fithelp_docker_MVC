<?php
// Import des fichiers utilisés par les modèles
require_once './config/database.php';
require_once './Models/Database.php';
require_once './Models/BaseModel.php';
require_once './Models/BodyPart.php';
require_once './Models/Exercise.php';



// helpers
require_once './helpers/http_helper.php';

// démarrage session
session_start();

// Import des contrôleurs

$page = $_GET['page'] ?? '';

$page = filter_var($page, FILTER_SANITIZE_SPECIAL_CHARS);

$path = match ($page) {
    '','showCase/home' => 'showCase/home',
    'showCase/detail' => 'showCase/detail',

    'exercises/add-exercise' => 'dashboard/exercises/add-exercise',
    'exercises/list-exercises' => 'dashboard/exercises/list-exercises',
    'exercises/update-exercise' => 'dashboard/exercises/update-exercise',

    'bodies-part/add-body-part' => 'dashboard/bodies-part/add-body-part',

    'categories/delete' => 'dashboard/categories/delete',

    'vehicles/list-vehicles' => 'dashboard/vehicles/list-vehicle',
    default => '404'
};

// Router
require_once './Controllers/' . $path . '-ctrl.php';