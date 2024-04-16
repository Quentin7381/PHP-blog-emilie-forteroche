<?php
    $sortName = $sortName ?? 'title';
    $active = $sort['name'] == $sortName ? '--active' : '';
    $direction = $sort['name'] == $sortName ? '--' . $sort['direction'] : '';
    $labels = [
        'title' => 'Titre',
        'date_creation' => 'Date de création',
        'nb_comment' => 'Nombre de commentaires',
        'vues' => 'Nombre de vues'
    ];
    $label = $labels[$sortName] 
?>

<button class="sortArticle__submit <?=$active.' '.$direction?>" type="submit" name="sort" value="<?=$sortName?>"><?=$label?></button>
