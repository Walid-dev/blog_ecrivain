<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<div id="postContainer" class="container" style="width: 90%;">
    <h1 class="text-center pt-5"><?= $post['title'] ?></h1>
    <hr class="mt-2 mb-2">
    <div class="row">
        <a class="btn return_btn mb-5 mt-5" href="index.php">Retour à la liste des chapitre</a>
    </div>
    <hr class="mt-2 mb-2">
    <div class="row">
        <div class="">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>

            <p>
                <?= nl2br($post['content']) ?>
            </p>
        </div>
    </div>


    <div class="row flex-column">

        <div class="comments_box mt-3 mb-3 p-2">
            <h4 class="text-center">Commentaires</h4>
            <?php
            while ($comment = $comments->fetch()) {
                ?>
                <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> :</p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            <?php
        }
        ?>
        </div>
        <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
            <div class="form-group">
                <label for="author">Auteur</label><br />
                <input class="form-control" type="text" id="author" name="author" />
            </div>
            <div class="form-group">
                <label for="comment">Commentaire</label><br />
                <textarea class="form-control" id="comment" name="comment"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>