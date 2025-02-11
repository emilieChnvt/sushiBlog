<h1>Sushis</h1>

<?php foreach ($sushis as $sushi): ?>

    <h3><?=$sushi->getName()?></h3>
    <p><?=$sushi->getIngredients()?></p>
    <a href="/sushi/show?id=<?=$sushi->getId()?>">see</a>

<?php endforeach;?>

