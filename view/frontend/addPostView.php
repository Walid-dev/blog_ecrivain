<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a class="btn btn-secondary mt-3" href="index.php">Retour à la liste des billets</a></p>

<h2>Ajouter un article</h2>


<form action="index.php?action=addArticle" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value="<?= $post['author'] ?>" />
    </div>
    <div>
        <label for="title">Titre</label><br />
        <textarea id="title" name="title"><?= $post['title'] ?></textarea>
    </div>
    <div>
        <label for="title">Texte</label><br />
        <textarea id="myTextArea" name="content"><?= $post['content'] ?></textarea>
    </div>
    <div id="buttonBox" class="d-flex mt-4">
        <?php if ($update == true) :
            ?>
            <button class="btn btn-info" type="submit" name="update">Update</button>
        <?php else : ?>
            <button class="btn btn-primary" type="submit" name="save">Save</button>
        <?php endif; ?>
        <div>
            <button type="submit" class="btn btn-warning ml-3" name="edit">Editer</button>
        </div>
        <div>
            <button type="submit" class="btn btn-danger ml-3" name="delete">Supprimer</button>
        </div>
    </div>
</form>

<?php echo $test; ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>