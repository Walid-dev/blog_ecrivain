<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a class="btn btn-secondary mt-3" href="index.php">Retour à la liste des billets</a></p>

<h2>Editer un article</h2>


<form action="index.php?action=updateArticle&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label>
        <input type="text" id="author" name="author" value="<?= $post['author'] ?>" />
    </div>
    <div>
        <label for="title">Titre</label>
        <textarea id="title" name="title" value=""><?= $post['title'] ?></textarea>
    </div>
    <div>
        <label for="title">Texte</label><br />
        <textarea id="myTextArea" name="content"><?= $post['content'] ?>></textarea>
    </div>
    <div id="buttonBox" class="d-flex mt-4">
        <button class="btn btn-info" type="submit" name="update">Update</button>
    </div>
</form>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>