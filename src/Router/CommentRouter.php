<?php

namespace Router;

class CommentRouter extends AbstractRouter {
    public function _index(){
        $this->_404();
    }

    /**
     * Appelle la methode d'ajout d'un commentaire.
     */
    public function add(){
        $controller = new \Controller\CommentController();
        $controller->addComment(
            $this->post['pseudo'],
            $this->post['content'],
            $this->post['article_id']
        );
    }

    public function delete(){
        if(!$this->previous instanceof AdminRouter){
            $this->_403();
            return;
        }

        $controller = new \Controller\CommentController();
        $controller->deleteComment(
            $this->url[0],
            $this->url[1]
        );
    }
}
