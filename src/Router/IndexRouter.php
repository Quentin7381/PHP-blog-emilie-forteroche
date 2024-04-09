<?php

namespace Router;
use Controller\AdminController;

class IndexRouter extends Router{

    public function _index(){
        $controller = new \Controller\ArticleController();
        $controller->showHome();
    }

    public function admin(){
        $controller = new AdminController();
        $controller->checkIfUserIsConnected();

        $router = new AdminRouter($this);
        $router->__ROUTE__();
    }

    public function user(){
        $router = new UserRouter($this);
        $router->__ROUTE__();
    }

    public function article(){
        $router = new ArticleRouter($this);
        $router->__ROUTE__();
    }

    public function comment(){
        $router = new CommentRouter($this);
        $router->__ROUTE__();
    }
}
