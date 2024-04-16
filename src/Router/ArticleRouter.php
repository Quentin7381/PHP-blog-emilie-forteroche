<?php

namespace Router;
use Controller\AdminController;

class ArticleRouter extends AbstractRouter{
    
    /**
     * Affiche la page d'accueil.
     */
    public function _index(){
        $controller = new \Controller\ArticleController();
        $controller->showHome();
    }

    /**
     * Si l'url est un id d'article valide, affiche l'article.
     * Sinon, affiche une erreur 404.
     */
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

    /**
     * Appelle la methode de mise a jour d'un article ou affiche le formulaire de mise a jour.
     */
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

    /**
     * Appelle la methode d'ajout d'un article ou affiche le formulaire d'ajout.
     */
    public function add(){
        if(!$this->__PREVIOUS__ instanceof AdminRouter){
            $this->_403();
            return;
        }

        $controller = new \Controller\ArticleController();

        $segment = $this->url[0] ?? null;
        if($segment == 'submit'){
            $controller->updateArticle(
                $this->post['title'],
                $this->post['content']
            );
            return;
        }

        $controller->showUpdateArticleForm();
    }

    /**
     * Appelle la methode de suppression d'un article.
     * L'id est le segment suivant de l'url.
     */
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
