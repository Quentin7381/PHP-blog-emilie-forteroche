<?php
    /**
     * Affichage de Liste des articles. 
     */
    use Utils\Utils;
?>

<div class="articleList">
    <?php foreach($articles as $article) { ?>
        <article class="article">
            <h2><?= $article->getTitle() ?></h2>
            <span class="quotation">«</span>
            <p><?= $article->getContent(400) ?></p>
            
            <div class="footer">
                <span class="info"> <?= ucfirst(Utils::convertDateToFrenchFormat($article->getDateCreation())) ?></span>
                <a class="info" href="/article/<?= $article->getId() ?>">Lire +</a>
            </div>
        </article>
    <?php } ?>
</div>