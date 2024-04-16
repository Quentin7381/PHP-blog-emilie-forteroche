<?php
    /**
     * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun. 
     * Et un formulaire pour ajouter un article.
     */

?>

<h2>Edition des articles</h2>

<div class="sortArticle">
    <form class="sortArticle__form" action=/admin method="POST">
    <!-- <h3 class="sortArticle__title">Trier par : </h3> -->
        <input type="hidden" name="actual_sort" value="<?=$sort['name']?>">
        <input type="hidden" name="actual_direction" value="<?=$sort['direction']?>">
        <?php foreach(['title', 'date_creation', 'nb_comment', 'vues'] as $sortName) {
            include __DIR__ . '/components/admin_sortButton.php';
        } ?>
    </form>
</div>

<table class="adminArticle">
    <tbody>
    <?php foreach ($articles as $article) {
        include __DIR__ . '/components/admin_articleLine.php';
    } ?>
    </tbody>
</table>

<a class="submit" href="/admin/article/add/">Ajouter un article</a>
