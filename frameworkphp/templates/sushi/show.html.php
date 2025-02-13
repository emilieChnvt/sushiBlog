
<div class="border">
    <h3><?=$sushi->getName()?></h3>
    <p><?=$sushi->getIngredients()?></p>
    <a href="/sushis">return</a>
    <a href="/sushi/delete?id=<?=$sushi->getId()?>">delete</a>
    <a href="/sushi/update?id=<?=$sushi->getId()?>">edit</a>

    <div class="border">
        <?php foreach ($sushi->getComments() as $comment) : ?>

            <p><strong><?= $comment->getContent() ?></strong></p>

        <?php endforeach; ?>
    </div>
    <form action="/comment/new" method="post">
        <input type="text" name="content" class="form-control:text">
        <input type="hidden" name="sushiId" value="<?=$sushi->getId() ?>">
        <button type="submit">Comment</button>
    </form>
</div>

