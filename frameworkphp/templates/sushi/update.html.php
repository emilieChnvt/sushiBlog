<div class="border p-5 ">
    <form action="/sushi/update?id=<?=$sushi->getId()?>" method="post" class="form form-control:post">
        <input type="text" name="name" value="<?= $sushi->getName() ?>">
        <input type="text" name="ingredients" value="<?= $sushi->getIngredients() ?>">

        <button class="btn btn-success" type="submit">Edit Post</button>
    </form>
    <a href="/">return</a>

</div>


