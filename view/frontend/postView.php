<?php ob_start(); ?>

<div class="row justify-content-center">
    <form action="index.php" method="POST">
        <div class="form-group">
            <label for="title">
                <input type="text" class="form-control" name="title" value="Enter your text" />
            </label>
        </div>
        <div class="form-group">
            <label for="author">
                <input type="text" class="form-control" name="author" value="Enter your name" />
            </label>
        </div>

        <div class="form-group">
            <label for="content">
                <textarea name="content" class="form-control" cols="30" rows="10"></textarea>
            </label>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" name="save" type="submit">Save</button>
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>