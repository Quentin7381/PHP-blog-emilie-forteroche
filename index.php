<?php

require_once __DIR__.'/config/config.php';
require_once __DIR__.'/vendor/autoload.php';
// require_once __DIR__.'/config/autoload.php';

use Utils\Utils;
use Router\IndexRouter;

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$url = $_SERVER['REQUEST_URI'];

// Try catch global pour gérer les erreurs
try {
    $router = new IndexRouter();
    // $router->debug = true;
    $router->__ROUTE__($url, $_GET);
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View\View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
    // throw $e;
}
