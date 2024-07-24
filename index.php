<?php
// Import des fichiers utilisés par les modèles
require_once './config/database.php';
require_once './Models/Database.php';
require_once './Models/BaseModel.php';


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
    'showCase/reservation' => 'showCase/reservation',
    'categories/list' => 'dashboard/categories/list',
    'categories/add' => 'dashboard/categories/add',
    'categories/update' => 'dashboard/categories/update',
    'categories/delete' => 'dashboard/categories/delete',
    'vehicles/add-vehicle' => 'dashboard/vehicles/add-vehicle',
    'vehicles/list-vehicles' => 'dashboard/vehicles/list-vehicle',
    default => '404'
};


// Router

require_once './Controllers/' . $path . '-ctrl.php';