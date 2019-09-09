<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function addPost()
{
    $postManager = new PostManager(); // Création d'un objet
    $post = $postManager->postPost(); // Appel d'une fonction de cet objet

    require('view/frontend/postView.php');
}
