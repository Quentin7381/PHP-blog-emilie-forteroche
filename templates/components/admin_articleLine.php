<?php
    use Utils\Utils;
    
    $i = $i ?? 1;
    $pairClass = ($i%2 == 0) ? "--pair" : "";
    ++$i;

    $date = Utils::convertDateToFrenchFormat($article->dateCreation);
    $confirm = Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?");
?>

<tr class="adminArticle__line <?=$pairClass?>">
    <td>
        <p class="adminArticle__title"><?=$article->getTitle()?></p>
        <p class="adminArticle__date"><?=$date?></p>
    </td>
    <td class="adminArticle__content"><?= $article->getContent(200) ?></td>
    <td class="adminArticle__infos">
        <p><span class="highlight"><?= $article->vues ?></span> vues</p>
        <p><span class="highlight"><?= $article->nbComments ?></span> commentaires</p>
    </td>
    <td>
        <div class="adminArticle__actions">
        <a class="adminArticle__actionsSubmit" href="/admin/article/update/<?= $article->getId() ?>">Modifier</a>
        <a class="adminArticle__actionsSubmit delete" href="/admin/article/delete/<?= $article->getId() ?>" <?= $confirm ?> >Supprimer</a>
        </div>
    </td>
</tr>
