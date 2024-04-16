<?php
    use Utils\Utils;
    $info = "Le " . Utils::convertDateToFrenchFormat($comment->getDateCreation());
    $info .= ", " . Utils::format($comment->getPseudo()) . " a écrit :";

    $content = Utils::format($comment->getContent());

    $confirm = Utils::askConfirmation("Voulez-vous vraiment supprimer ce commentaire ?");
?>

<li>
    <?php if($admin): ?>
        <a class="delete" href="/admin/comment/delete/<?= $article->getId() ?>/<?=$comment->id?>" <?=$confirm?>>⨯</a>
    <?php endif; ?>
    <div class="smiley">☻</div>
    <div class="detailComment">
        <h3 class="info"><?=$info?></h3>
        <p class="content"><?=$content?></p>
    </div>
</li>
