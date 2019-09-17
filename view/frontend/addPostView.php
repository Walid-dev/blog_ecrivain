<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a class="btn btn-secondary mt-3" href="index.php">Retour à la liste des billets</a></p>

<h2>Ajouter un article</h2>


<form action="index.php?action=addArticle" method="post">
    <div>
        <label for="author">Auteur</label>
        <input type="text" id="author" name="author" value="author" />
    </div>
    <div>
        <label for="title">Titre</label>
        <textarea id="title" name="title">Texte</textarea>
    </div>
    <div>
        <label for="title">Texte</label><br />
        <textarea id="myTextArea" name="content"></textarea>
    </div>
    <div id="buttonBox" class="d-flex mt-4">
        <button class="btn btn-primary" type="submit" name="save">Save</button>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>