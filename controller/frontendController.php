<?php

// Chargement des classes

require_once('model/Manager.php');
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/loginSystemManager.php');


function addUser()
{
    $loginSystemManager = new LoginSystemManager();
    $addUser = $loginSystemManager->addUser();
}

function login()
{
    $loginSystemManager = new LoginSystemManager();
    $addUser = $loginSystemManager->login();
}

function logout()
{
    $loginSystemManager = new LoginSystemManager();
    $logout = $loginSystemManager->logout();
}



function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts();
    // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function pagination()
{
    $postManager = new PostManager();
    $postManager->pagination();
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);


    require('view/frontend/postView.php');
}

function listComments()
{
    $commentManager = new CommentManager();
    $comments = $commentManager->listComments();



    require('view/frontend/listCommentsView.php');
}

function deleteComment($id)
{

    $commentManager = new CommentManager();
    $commentManager->listComments();
    $commentManager->deleteComment($id);

    $_SESSION['message'] = "Le commentaire à été supprimé";
    $_SESSION['msg_type'] = "danger";

    header('Location: index.php?action=listComments#tableCommentsTitle');
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
    //  unset($_POST);
}

function postArticle($author, $title, $content)
{
    $postManager = new PostManager();
    $postManager->postArticle($author, $title, $content);

    echo '<div class="alert alert-success add_article_msg">Article ajouté</div>';
}

function deleteArticle($id)
{
    $postManager = new PostManager();
    $postManager->deleteFromDataBase($id);

    $_SESSION['message'] = "L'article a été supprimé.";
    $_SESSION['msg_type'] = "danger";

    header('Location: index.php#sectionArticles');
}

function editArticle()
{
    $postManager = new PostManager();
    $post = $postManager->getPost($_GET['id']);

    require('view/frontend/editPostView.php');
}

function updateArticle($id, $author, $title, $content)
{
    $postManager = new PostManager();
    $postManager->updatePost($id, $author, $title, $content);

    $_SESSION['message'] = "L'article a été mis à jour.";
    $_SESSION['msg_type'] = "info";

    header('Location: index.php#sectionArticles');
}


function signal($id, $variable, $commentStatus)
{
    $commentManager = new CommentManager();
    $commentManager->signal($id, $variable, $commentStatus);

    $_SESSION['message'] = "L'article a été signalé.";
    $_SESSION['msg_type'] = "warning";

    header('Location: index.php?action=post&id=' . $_GET['id'] . '#commentBox');
}


function validateComment($id)
{
    $commentManager = new CommentManager();
    $commentManager->validateComment($id);

    header('Location: index.php?action=listComments#tableCommentsTitle');

    $_SESSION['message'] = "L'e commentaire à été validé";
    $_SESSION['msg_type'] = "info";
}
