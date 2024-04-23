<?php
    $sortName = $sortName ?? 'title';
    $active = $sort['name'] == $sortName ? '--active' : '';
    $direction = $sort['name'] == $sortName ? '--' . $sort['direction'] : '';

    $arrows = "<span class='sortArticle__arrow --ASC'>▲</span><span class='sortArticle__arrow --DESC'>▼</span>";
    
    $labels = [
        'title' => 'Titre',
        'date_creation' => 'Date de création',
        'nb_comments' => 'Nombre de commentaires',
        'vues' => 'Nombre de vues'
    ];
    $label = "<span class='sortArticle__label'>" . $labels[$sortName] . "</span>";
?>

<button
    class="sortArticle__submit <?=$active.' '.$direction?>"
    type="submit"
    name="sort"
    value="<?=$sortName?>"
><?=$label?> <?=$arrows?></button>
