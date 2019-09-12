<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<h1>Blog Ecrivain</h1>
<p>Derniers billets du blog :</p>

<?php
while ($data = $posts->fetch()) {
    ?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>

        <p><?= ($data['author']) ?></p>

        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-info">Commentaire</a>
            <a href="index.php?action=edit&amp;id=<?= $data['id'] ?>" class="btn btn-warning">Editer</a>
            <a href="index.php?action=delete&amp;id=<?= $data['id'] ?>" class="btn btn-danger">Supprimer</a>

            <?php
            $check = $data['id'];

            echo "$check"; ?>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>