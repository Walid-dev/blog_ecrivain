<?php ob_start(); ?>

<?php if (isset($_SESSION['message'])) : ?>

    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
        <?php echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>

<div class="container">
    <div class="title_box text-center mt-5 mb-5">
        <h1 class="display-4">Blog Ecrivain</h1>
        <hr>
        <h3><small class="text-muted">Derniers billets du blog :</small></h3>
    </div>
    <?php
    while ($data = $posts->fetch()) {
        ?>
        <div class="jumbotron article_jumbotron">
            <h2 class="display-5 mb-3 text-center"><?= strip_tags($data['title']) ?></h2>
            <p class="lead content_article_box"><?= strip_tags($data['content']) ?></p>
            <hr class="my-4">
            <blockquote class="blockquote text-left">
                <footer class="blockquote-footer">Par <?= $data['author'] ?><cite title="Source Title"> le <?= $data['creation_date_fr'] ?></cite></footer>
            </blockquote>
            <p class="lead mt-4">
                <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn modal_btn mr-1 ml-3">Lire..</a>
                <?php
                if (isset($_SESSION['usertype']) == 1) {
                    require('view/frontend/adminButtonsView.php');
                }
                ?>
            </p>
        </div>
        <hr class="col-md-6 ml-auto mt-5 mb-5">
        <section>
    <div class="content">
        <h2>Section One Text Block Reveal</h2>
        <h3>Text Block Reveal On Page Scroll</h3>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor fugiat ab necessitatibus, quisquam alias iure, recusandae soluta non maxime, sed dolorem ducimus. Atque sed eaque ipsam nihil, sint amet cupiditate.lore
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat corporis consequatur assumenda excepturi maiores ex saepe alias laborum optio laboriosam officiis at libero, beatae magni aperiam facilis illum porro! Libero!
           <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias obcaecati nihil dolores labore, atque beatae earum sapiente vel distinctio minus ut suscipit harum magni nisi nulla repudiandae expedita sunt tempora?
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
    </div>
</section>
    <?php
}


$posts->closeCursor();
?>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>