<?php ob_start(); ?>

<?php if (isset($_SESSION['message'])) : ?>

    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
        <?php echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>

<div class="container-fluid">
    <?php
    $chapters = 0;

    while ($data = $posts->fetch()) {
        $chapters++;
        ?>
        <section class="articles_section container-fluid">
            <div class="article_content col-md-10 col-12">
                <h2 class="mb-3">Chapitre: <?php
                                            echo $chapters  ?>
                </h2>
                <h3 class="mb-3"><?= $data['title'] ?></h3>
                <p class="mb-3"><?= $data['content'] ?></p>
                <blockquote class="blockquote mb-3 mt-2 article_author_and_date text-left">
                    <footer class="blockquote-footer">Par <?= $data['author'] ?><cite title="Source Title"> le <?= $data['creation_date_fr'] ?></cite></footer>
                </blockquote>
                <div class="articles_btn_box mt-2">
                    <a href="index.php?action=post&amp;id=<?= $data['id'] . "#postContainer" ?>" class="btn admin_btn mr-1 mr-1">Lire..</a>
                    <?php
                    if (isset($_SESSION['usertype']) == 1) {
                        require('view/frontend/adminButtonsView.php');
                    }
                    ?>
                </div>
            </div>
        </section>
        <hr class="articles_hr">

    <?php
}


$posts->closeCursor();
?>


    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>