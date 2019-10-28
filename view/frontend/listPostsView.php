<?php ob_start(); ?>
<section id="sectionArticles" class="articles_section container-fluid">

    <?php
    while ($data = $posts->fetch()) {
        ?>
        <div class="article_content col-md-10 col-12">
            <h2 class="mb-3"><?= $data['title'] ?></h2>
            <h3 class="mb-3"><?= $data['author'] ?></h3>
            <p class="mb-3">
                <?= shortArticle($data); ?>
            </p>
            <blockquote class="blockquote mb-3 mt-2 article_author_and_date text-left">
                <footer class="blockquote-footer">Par <?= $data['author'] ?><cite title="Source Title"> le <?= $data['creation_date_fr'] ?></cite></footer>
            </blockquote>
            <div class="articles_btn_box mt-4">
                <a href="index.php?action=post&amp;id=<?= $data['id'] . "#postContainer" ?>" class="btn admin_btn mr-1 mr-1">Lire..</a>
                <?= checkUserTypeOnPosts($data); ?>
            </div>
        </div>
        <hr class="articles_hr mb-0">

    <?php
}
$posts->closeCursor();
?>
</section>
<div id="content" class="text-black text-center"><?php pagination(); ?></div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>