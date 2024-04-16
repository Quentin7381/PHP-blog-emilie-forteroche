<?php

namespace Router;

class AdminRouter extends AbstractRouter {
        
    /**
     * Affiche la page d'accueil de l'admin.
     */
    public function _index(){
        $controller = new \Controller\AdminController();
        $controller->showAdmin();
    }

    /**
     * Appelle le router des articles.
     */
    public function article(){
        $router = new ArticleRouter($this);
        $router->__ROUTE__();
    }
}
