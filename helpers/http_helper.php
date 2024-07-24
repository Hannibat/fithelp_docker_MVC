<?php
/**
 * Fonction de rendu des templates correspond à chaque vue
 * @param string $path | nom de la portition du chemin allant du dossier view au fichier à utiliser
 * @param array $params | données à passer à la vue pour affichage. ex : title, categories,...
 */
function renderView(string $path, array $params = []): void
{
    // Crée des variable à partir d'un tableau associatif. Clé ==> Nom de la variable, Valeur ==> Valeur de la variable.
    extract($params);
    // Inclusion des fichiers partiels
    require_once __DIR__ . '/../Views/' . $path  . '.php';
    require_once __DIR__ . '/../Views/template.php';
}

/**
 * Redirection HTTP vers une autre route
 * @param string $path | nom de la route
 */
function redirectToRoute($path) {
    header('Location: ?page=' . $path);
    exit();
}

function addFlash(string $type, string $message)
{
    $_SESSION['flashes']['type'] = $type;
    $_SESSION['flashes']['message'] = $message;
}

function getFlash() {
    $flash = [];
    if(isset($_SESSION['flashes'])) {
        $flash['type'] =  $_SESSION['flashes']['type'];
        $flash['message'] =  $_SESSION['flashes']['message'];
    }
    unset($_SESSION['flashes']);
    return $flash;
}