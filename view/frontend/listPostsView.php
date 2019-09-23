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
            <p class="lead text-center mt-4">
                <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-sm btn-info">Commentaire</a>
                <a href="index.php?action=edit&amp;id=<?= $data['id'] ?>" class="btn btn-sm btn-warning">Editer</a>
                <a href="index.php?action=delete&amp;id=<?= $data['id'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
            </p>
        </div>
        <hr class="col-md-6 ml-auto mt-5 mb-5">
    <?php
}

$posts->closeCursor();
?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>