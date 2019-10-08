<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<div id="postContainer" class="container" style="width: 90%;">
    <h1 class="text-center pt-5"><?= $post['title'] ?></h1>
    <hr class="mt-2 mb-2">
    <div class="row">
        <a class="up btn return_btn mb-5 mt-5" href="index.php">Retour à la liste des chapitre</a>
    </div>
    <hr class="mt-2 mb-2">
    <div class="row">
        <div class="">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
            </h3>

            <p>
                <?= nl2br($post['content']) ?>
            </p>
            <blockquote class="blockquote mb-3 mt-2 article_author_and_date text-left">
                <footer class="blockquote-footer">Par <?= $post['author'] ?><cite title="Source Title"> le <?= $post['creation_date_fr'] ?></cite></footer>
            </blockquote>
        </div>
    </div>


    <div class="row flex-column col-md-10 pl-0">

        <div class="comments_box mt-5 mb-3 p-3">
            <h4 class="text-center">Commentaires</h4>
            <?php
            while ($comment = $comments->fetch()) {
                ?>
                <p><?= htmlspecialchars($comment['author']) ?> le <?= $comment['comment_date_fr'] ?> :</p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                <form action="index.php" method="post">
                    <input type="hidden" value="<?= $comment['id'] ?>" name="commentId" />
                    <input type="hidden" value="1" name="commentStatus" />
                    <input type="hidden" value="<?php if ($comment['comment_status'] == 0) {
                                                    echo $comment['report'] + 1;
                                                } else {
                                                    $comment['report'];
                                                }
                                                ?>" name="report" />
                    <input class="btn btn-sm btn-warning mb-2" type="submit" name="test" value="Signaler <?= $comment['report'] ?>">
                </form>
                <hr>
            <?php
        }
        ?>
        </div>
        <?php

        if (isset($_SESSION['usertype'])) {
            if ($_SESSION['usertype'] == 1 || $_SESSION['usertype'] == 2) {
                require("view/frontend/formCommentView.php");
            } else {
                echo "Se connecter ou créer un compte pour ajouter un commentaire";
            }
        } else {
            require("view/frontend/signupModalView.php");
        }














        ?>



    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>