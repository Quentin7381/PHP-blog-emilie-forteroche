<?php 
/**
 * Contrôleur de la partie admin.
 */

namespace Controller;

use Exception;
use Entity\Article;
use Manager\ArticleManager;
use Manager\UserManager;
use View\View;
use Utils\Utils;
 
class AdminController {

    // ----- ROUTE METHODS -----

    /**
     * Affiche la page d'administration.
     * @return void
     */
    public function showAdmin() : void
    {
        // On vérifie que l'utilisateur est connecté.
        $this->checkIfUserIsConnected();

        // On récupère le tri demandé.
        $sort = [
            'name' => Utils::request("sort") ?? "date_creation",
            'direction' => "DESC"
        ];

        // On inverse la direction si le tri est le même que le tri actuel.
        if($sort['name'] == Utils::request("actual_sort")){
            $sort['direction'] = Utils::request("actual_direction");
            $sort['direction'] = $sort['direction'] == "ASC" ? "DESC" : "ASC";
        }

        // On récupère les articles.
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles($sort);

        // On affiche la page d'administration.
        $view = new View("Administration");
        $view->render("admin", [
            'articles' => $articles,
            'sort' => $sort,
        ]);
    }

    /**
     * Affichage du formulaire de connexion.
     * @return void
     */
    public function connect() : void
    {
        $view = new View("Connexion");
        $view->render("connectionForm");
    }

    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    public function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("user/connect");
        }
    }

    public function isConnected() : bool
    {
        return isset($_SESSION['user']);
    }

    /**
     * Connexion de l'utilisateur.
     * @return void
     */
    public function connectUser() : void
    {
        // On récupère les données du formulaire.
        $login = Utils::request("login");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($login) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByLogin($login);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect : $hash");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        // On redirige vers la page d'administration.
        Utils::redirect("admin");
    }

    /**
     * Déconnexion de l'utilisateur.
     * @return void
     */
    public function disconnectUser() : void 
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);

        // On redirige vers la page d'accueil.
        Utils::redirect("/");
    }
}
