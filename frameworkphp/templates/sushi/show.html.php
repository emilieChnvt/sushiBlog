
<div class="border">
    <h3><?=$sushi->getName()?></h3>
    <p><?=$sushi->getIngredients()?></p>
    <a href="/sushis">return</a>
    <a href="/sushi/delete?id=<?=$sushi->getId()?>">delete</a>

</div>