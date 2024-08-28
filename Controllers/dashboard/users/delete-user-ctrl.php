<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        // Récupération du paramètre d'URL correspondant à l'id de la catégorie cliquée
        $user_id = intval(filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT));
        if ($user_id) {
            // Récupération de l'utilisateur
            $user = User::getOneUser($user_id);
            if ($user) {
                // Appel de la méthode delete
                $isDeleted = User::deleteUser($user_id);
                if ($isDeleted) {
                    $_SESSION['flash_message'] = "L'utilisateur a été supprimé avec succès.";
                    header('Location: /?page=users/list-users');
                    exit();
                } else {
                    $error = 'La suppression a échoué. Veuillez réessayer.';
                }
            } else {
                $error = 'Utilisateur non trouvé.';
            }
        }
    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
}
