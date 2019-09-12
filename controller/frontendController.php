<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function addArticle()
{
    $postManager = new PostManager();

    $postManager->addArticle();
}

function postArticle($author, $title, $content)
{
    $postManager = new PostManager();

    $postManager->postArticle($author, $title, $content);

    header('Location: index.php');
}

function deleteArticle($id)
{
    $postManager = new PostManager();
    $postManager->deleteFromDataBase($id);

    header('Location: index.php');
}

function editArticle()
{
    $update = true;
    $postManager = new PostManager(); // Création d'un objet

    $post = $postManager->getPost($_GET['id']);

    require('view/frontend/addPostView.php');
}

function updateArticle()
{


    header('Location: index.php');
}
