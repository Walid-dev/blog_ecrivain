<?php ob_start(); ?>

<?php if (isset($_SESSION['message'])) : ?>

    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
        <?php echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>

<div class="container">
    <div class="row">
        <a id="tableCommentsTitle" class="up btn return_btn mb-5 mt-5" href="index.php">Retour à la liste des chapitre</a>
    </div>
    <h2 class="mb-5 mt-2 text-center">Tableau des commentaires</h2>
    <hr>
    <div class="row justify-content-center">
        <table id="commentsTable" class="table table-hover table-responsive table-dark">
            <thead>
                <tr>
                    <th scope="row" style="width: 10%;">Chapitre</th>
                    <th scope="row" style="width: 10%;">Auteur</th>
                    <th scope="row" style="width: 10%;">Signalement</th>
                    <th scope="row" style="width: 50%;">Commentaire</th>
                    <th scope="row" style="width: 20%;">Action</th>
                </tr>
            </thead>
            <?php


            while ($data = $comments->fetch()) {
                if ($data['comment_status'] == 1) {
                    require('view/frontend/commentsTableRowView.php');
                }
                ?>





            <?php

        }


        $comments->closeCursor();
        ?>


        </table>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>