<?php 

namespace Controller;

use Exception;
use Manager\ArticleManager;
use Manager\CommentManager;
use Utils\Utils;
use View\View;
use Entity\Article;

class ArticleController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        $view = new View("Accueil");
        $view->render("home", [
            'articles' => $articles
        ]);
    }

    public function articleExists(int $id) : bool
    {
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);
        return $article !== null;
    }

    /**
     * Affiche le détail d'un article.
     * @return void
     */
    public function showArticle(int $id) : void
    {
        // Ajout d'une vue si l'utilisateur n'est pas l'admin.
        $adminController = new AdminController();
        if(!$adminController->isConnected()){
            $articleManager = new ArticleManager();
            $articleManager->addView($id);
        }

        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);
        
        if (!$article) {
            throw new Exception("L'article demandé n'existe pas.");
        }

        $commentManager = new CommentManager();
        $comments = $commentManager->getAllCommentsByArticleId($id);

        $adminController = new AdminController();
        $admin = $adminController->isConnected();

        $view = new View($article->getTitle());
        $view->render("detailArticle", [
            'article' => $article,
            'comments' => $comments,
            'admin' => $admin
        ]);
    }

    /**
     * Affiche le formulaire d'ajout d'un article.
     * @return void
     */
    public function addArticle() : void
    {
        $view = new View("Ajouter un article");
        $view->render("addArticle");
    }

    /**
     * Affiche la page "à propos".
     * @return void
     */
    public function showApropos() {
        $view = new View("A propos");
        $view->render("apropos");
    }

    /**
     * Affichage du formulaire d'ajout d'un article.
     * @return void
     */
    public function showUpdateArticleForm($id = -1) : void{

        // On récupère l'article associé.
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);

        // Si l'article n'existe pas, on en crée un vide. 
        if (!$article) {
            $article = new Article();
        }

        // On affiche la page de modification de l'article.
        $view = new View("Edition d'un article");
        $view->render("updateArticleForm", [
            'article' => $article
        ]);
    }

    /**
     * Suppression d'un article.
     * @return void
     */
    public function deleteArticle($id) : void
    {
        // On supprime l'article.
        $articleManager = new ArticleManager();
        $articleManager->deleteArticle($id);
       
        // On redirige vers la page d'administration.
        Utils::redirect("admin");
    }

    /**
     * Ajout et modification d'un article.
     * On sait si un article est ajouté car l'id vaut -1.
     * @return void
     */
    public function updateArticle() : void{
        $id = Utils::request("id");
        $title = Utils::request("title");
        $content = Utils::request("content");
        
        // On vérifie que les données sont valides.
        if (empty($title) || empty($content)) {
            throw new Exception("Tous les champs sont obligatoires. 2");
        }

        // On crée l'objet Article.

        $article = new Article([
            'id' => $id, // Si l'id vaut -1, l'article sera ajouté. Sinon, il sera modifié.
            'title' => $title,
            'content' => $content,
            'id_user' => $_SESSION['idUser']
        ]);

        // On ajoute l'article.
        $articleManager = new ArticleManager();
        $articleManager->addOrUpdateArticle($article);

        // On redirige vers la page d'administration.
        Utils::redirect("admin");
    }
}
