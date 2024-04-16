<?php
    /**
     * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun. 
     * Et un formulaire pour ajouter un article.
     */

    use Utils\Utils;
    use Controller\CommentController;
    $commentController = new CommentController();
?>

<h2>Edition des articles</h2>

<div class="sortArticle">
<h3 class="sortArticle__title">Trier par ...</h3>
    <form class="sortArticle__form" action=/admin method="POST">
        <input type="hidden" name="actual_sort" value="<?=$sort['name']?>">
        <input type="hidden" name="actual_direction" value="<?=$sort['direction']?>">
        <?php foreach(['title', 'date_creation', 'nb_comment', 'vues'] as $sortName) : ?>
            <?php $active = $sort['name'] == $sortName ? '--active' : '' ?>
            <?php $direction = $sort['name'] == $sortName ? $sort['direction'] : 'ASC' ?>
            <?php $label = ucfirst(str_replace('_', ' ', $sortName)) ?>
            <button class="sortArticle__submit <?=$active.' '.$direction?>" type="submit" name="sort" value="<?=$sortName?>"><?=$label?></button>
        <?php endforeach; ?>
    </form>
</div>

<table class="adminArticle">
    <tbody>
    <?php foreach ($articles as $article) { ?>
        <tr class="adminArticle__line">
            <td class="adminArticle__title"><?= $article->getTitle() ?></td>
            <td class="adminArticle__content"><?= $article->getContent(200) ?></td>
            <td class="adminArticle__infos">
                <p><?= $article->vues ?> vues</p>
                <p><?= $article->nbComments ?> commentaires</p>
                <p class="adminArticle__InfosPublication"><?= Utils::convertDateToFrenchFormat($article->dateCreation)?></p>
            </td>
            <td class="adminArticle__actions">
                <a class="submit" href="/admin/article/update/<?= $article->getId() ?>">Modifier</a>
                <a class="submit" href="/admin/article/delete/<?= $article->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?") ?> >Supprimer</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<a class="submit" href="/admin/article/add/">Ajouter un article</a>
