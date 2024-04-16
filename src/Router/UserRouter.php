<?php

namespace Router;

class UserRouter extends AbstractRouter {
    public function _index(){
        $this->_404();
    }

    /**
     * Affiche le formulaire de connexion de l'admin.
     */
    public function connect(){
        $controller = new \Controller\AdminController();
        $controller->connect();
    }

    /**
     * Appelle la methode de connexion de l'admin.
     */
    public function submit(){
        $controller = new \Controller\AdminController();
        $controller->connectUser();
    }

    /**
     * Appelle la methode de deconnexion de l'admin.
     */
    public function disconnect(){
        $controller = new \Controller\AdminController();
        $controller->disconnectUser();
    }
}
