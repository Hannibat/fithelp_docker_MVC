<?php

// Détruit toutes les variables de session
$_SESSION = array();

session_destroy();

redirectToRoute('');