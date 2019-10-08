<?php

// Chargement des classes

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

function display()
{
    $postManager = new PostManager();
    $postManager->display();
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

    $_SESSION['message'] = "L'article a été ajouté.";
    $_SESSION['msg_type'] = "success";
}

function deleteArticle($id)
{
    $postManager = new PostManager();
    $postManager->deleteFromDataBase($id);

    $_SESSION['message'] = "L'article a été supprimé.";
    $_SESSION['msg_type'] = "danger";

    header('Location: index.php');
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

    header('Location: index.php');
}


function test($id, $variable, $commentStatus)
{
    $commentManager = new CommentManager();
    $commentManager->test($id, $variable, $commentStatus);

    echo "->id: " . $id . "->variable: " . $variable . "->commentSTatus: " . $commentStatus;
}
