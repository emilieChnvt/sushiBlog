<h1>Sushis</h1>

<?php foreach ($sushis as $sushi): ?>

   <div class="border p-5">
       <h3><?=$sushi->getName()?></h3>
       <p><?=$sushi->getIngredients()?></p>
       <a href="/sushi/show?id=<?=$sushi->getId()?>">see</a>
       <a href="/sushi/delete?id=<?=$sushi->getId()?>">delete</a>

   </div>

<?php endforeach;?>

