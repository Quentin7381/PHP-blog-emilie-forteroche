<?php

namespace Controller;
use Utils\Utils;
use Exception;

use Manager\CommentManager;
use Entity\Comment as CommentEntity;

use Manager\ArticleManager;

class CommentController
{
    /**
     * Ajoute un commentaire.
     * @return void
     */
    public function addComment($pseudo, $content, $idArticle) : void{

        // On vérifie que les données sont valides.
        if (empty($pseudo) || empty($content) || empty($idArticle)) {
            throw new Exception("Tous les champs sont obligatoires. 3");
        }

        // On vérifie que l'article existe.
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($idArticle);
        if (!$article) {
            throw new Exception("L'article demandé n'existe pas.");
        }

        // On crée l'objet Comment.
        $comment = new CommentEntity([
            'pseudo' => $pseudo,
            'content' => $content,
            'idArticle' => $idArticle
        ]);

        // On ajoute le commentaire.
        $commentManager = new CommentManager();
        $result = $commentManager->addComment($comment);

        // On vérifie que l'ajout a bien fonctionné.
        if (!$result) {
            throw new Exception("Une erreur est survenue lors de l'ajout du commentaire.");
        }

        // On redirige vers la page de l'article.
        Utils::redirect("article/" . $idArticle);
    }

    /**
     * Supprime un commentaire.
     * @return void
     */
    public function deleteComment($articleId, $commentId) : void
    {
        // On supprime le commentaire.
        $commentManager = new CommentManager();
        $comment = $commentManager->getCommentById($commentId);
        $commentManager->deleteComment($comment);
       
        // On redirige vers la page de l'article.
        Utils::redirect("article/" . $articleId);
    }
}