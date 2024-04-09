<?php

namespace Router;
use Controller\AdminController;

class ArticleRouter extends Router{
    
    public function _index(){
        $controller = new \Controller\ArticleController();
        $controller->showHome();
    }

    public function _404(){
        $id = $this->oldUrl ?? -1;

        $controller = new \Controller\ArticleController();
        try{
            $controller->showArticle($id);
        }
        catch(\Throwable $e){
            parent::_404();
        }
    }

    public function update(){
        if(!$this->__PREVIOUS__ instanceof AdminRouter){
            $this->_403();
            return;
        }

        $id = $this->url[0];

        $controller = new \Controller\ArticleController();

        if($id == 'submit'){
            $controller->updateArticle(
                $this->post['title'],
                $this->post['content'],
                $this->post['id'] ?? -1
            );
            return;
        }

        $controller->showUpdateArticleForm($id);
    }

    public function add(){
        if(!$this->__PREVIOUS__ instanceof AdminRouter){
            $this->_403();
            return;
        }

        $controller = new \Controller\ArticleController();

        $url = $this->url[0] ?? null;
        if($url == 'submit'){
            $controller->updateArticle(
                $this->post['title'],
                $this->post['content']
            );
            return;
        }

        $controller->showUpdateArticleForm();
    }

    public function delete(){
        if(!$this->__PREVIOUS__ instanceof AdminRouter){
            $this->_403();
            return;
        }

        $id = $this->url[0];

        $controller = new \Controller\ArticleController();
        $controller->deleteArticle($id);
    }
}
