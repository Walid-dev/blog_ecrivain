<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<h2>Ajouter un article</h2>

<form action="index.php?action=addArticle" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="title">Titre</label><br />
        <textarea id="title" name="title"></textarea>
    </div>
    <div>
        <label for="title">Texte</label><br />
        <textarea id="content" name="content"></textarea>
    </div>
    <div>
        <button type="submit" name="save">Save</button>
    </div>
    <div>
        <button type="submit" name="edit">Edit</button>
    </div>
    <div>
        <button type="submit" name="delete">Delete</button>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>