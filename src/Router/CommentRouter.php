<?php

namespace Router;

class CommentRouter extends Router {
    public function _index(){
        $this->_404();
    }

    public function add(){
        $controller = new \Controller\CommentController();
        $controller->addComment(
            $this->post['pseudo'],
            $this->post['content'],
            $this->post['article_id']
        );
    }

    // public function delete(){
    //     $controller = new \Controller\CommentController();
    //     $controller->deleteComment(
    //         $this->url[0]
    //     );
    // }
}
