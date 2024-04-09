<?php

namespace Router;

class UserRouter extends Router {
    public function _index(){
        $this->_404();
    }

    public function connect(){
        $controller = new \Controller\AdminController();
        $controller->connect();
    }

    public function submit(){
        $controller = new \Controller\AdminController();
        $controller->connectUser();
    }

    public function disconnect(){
        $controller = new \Controller\AdminController();
        $controller->disconnectUser();
    }
}
