<form class="form form-control" action="/comment/edit" method="POST">
    <input type="text" name="content"  required>
    <input type="hidden" name="sushiId" value="<?=$comment->getSushiId() ?>">

    <button type="submit">Comment</button>
</form>

