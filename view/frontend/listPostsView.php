<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<?php if (isset($_SESSION['message'])) : ?>

    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
        <?php echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>

<div class="container-fluid">
    <h1 class="display-3">Blog Ecrivain</h1>
    <h3><small class="text-muted">Derniers billets du blog :</small></h3>
    <?php
    while ($data = $posts->fetch()) {
        ?>
        <div class="news">
            <h3>
                <?= htmlspecialchars($data['title']) ?>
                <em>le <?= $data['creation_date_fr'] ?></em>
            </h3>
            <p>
                <?= strip_tags($data['content']) ?>
                <br />
                <p><?= ($data['author']) ?></p>
                <div class="btnBox mt-3">
                    <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-sm btn-info">Commentaire</a>
                    <a href="index.php?action=edit&amp;id=<?= $data['id'] ?>" class="btn btn-sm btn-warning">Editer</a>
                    <a href="index.php?action=delete&amp;id=<?= $data['id'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
                </div>
            </p>
        </div>
    <?php
}
$posts->closeCursor();
?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>