<?php

namespace Router;
use Controller\AdminController;

class IndexRouter extends AbstractRouter{

    /**
     * Affiche la page d'accueil.
     */
    public function _index(){
        $controller = new \Controller\ArticleController();
        $controller->showHome();
    }

    /**
     * Appelle le router de l'admin.
     */
    public function admin(){
        $controller = new AdminController();
        $controller->checkIfUserIsConnected();

        $router = new AdminRouter($this);
        $router->__ROUTE__();
    }

    /**
     * Appelle le router des utilisateurs.
     */
    public function user(){
        $router = new UserRouter($this);
        $router->__ROUTE__();
    }

    /**
     * Appelle le router des articles.
     */
    public function article(){
        $router = new ArticleRouter($this);
        $router->__ROUTE__();
    }

    /**
     * Appelle le router des commentaires.
     */
    public function comment(){
        $router = new CommentRouter($this);
        $router->__ROUTE__();
    }
}
