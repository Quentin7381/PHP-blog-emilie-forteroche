<?php

namespace Router;

class AdminRouter extends Router {
        
        public function _index(){
            $controller = new \Controller\AdminController();
            $controller->showAdmin();
        }

        public function article(){
            $router = new ArticleRouter($this);
            $router->__ROUTE__();
        }
}
