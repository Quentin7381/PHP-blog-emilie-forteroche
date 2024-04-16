<?php
    use Utils\Utils;
    
    $i = $i ?? 0;
    $impairClass = ($i%2 == 0) ? "--impair" : "";
    ++$i;

    $date = Utils::convertDateToFrenchFormat($article->dateCreation);
    $confirm = Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?");
?>

<tr class="adminArticle__line">
    <td class="adminArticle__title"><?= $article->getTitle() ?></td>
    <td class="adminArticle__content"><?= $article->getContent(200) ?></td>
    <td class="adminArticle__infos">
        <p><span class="highlight"><?= $article->vues ?></span> vues</p>
        <p><span class="highlight"><?= $article->nbComments ?></span> commentaires</p>
        <p class="adminArticle__InfosPublication"><?= $date ?></p>
    </td>
    <td>
        <div class="adminArticle__actions">
        <a class="adminArticle__actionsSubmit" href="/admin/article/update/<?= $article->getId() ?>">Modifier</a>
        <a class="adminArticle__actionsSubmit delete" href="/admin/article/delete/<?= $article->getId() ?>" <?= $confirm ?> >Supprimer</a>
        </div>
    </td>
</tr>
