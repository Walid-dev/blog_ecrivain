<?php

// Loading classes

require_once('model/Manager.php');
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/loginSystemManager.php');

// Login Logout Register Section

// Check and register the submitted values
function addUser()
{
    $loginSystemManager = new LoginSystemManager();
    $addUser = $loginSystemManager->addUser();

    $_SESSION['message'] = "Votre compte à bien été crée.";
    $_SESSION['msg_type'] = "info";
}

// Check submitted values and give access
function login()
{
    $loginSystemManager = new LoginSystemManager();
    $addUser = $loginSystemManager->login();
}

// Deconnect Users / Close Session
function logout()
{
    $loginSystemManager = new LoginSystemManager();
    $logout = $loginSystemManager->logout();
}

// Check the usertype and display or not the admin buttons
function checkUserTypeOnPosts($data)
{
    if (isset($_SESSION['usertype'])) {
        if (($_SESSION['usertype'] == 2)) {
            require('view/frontend/adminButtonsView.php');
        }
    }
}

// Check the usertype and display or not the admin buttons on the header

function checkUserTypeOnHeader()
{
    if (isset($_SESSION['usertype'])) {
        // Check if the user is an Admin to display admin buttons
        if (($_SESSION['usertype'] == 2)) {
            require('view/frontend/adminButtonsView2.php');
        }
    }
}

// Display the sugnup or the login Modal

function displayModal()
{
    if (isset($_SESSION['userId'])) {
        require "view/frontend/logModalView.php";
    } else {
        require "view/frontend/signupModalView.php";
    }
}

// Check if user and allow to add comment or display the signup modal
function checkUserTypeToComment($post)
{
    if (isset($_SESSION['usertype'])) {
        if ($_SESSION['usertype'] == 1 || $_SESSION['usertype'] == 2) {
            // Check if the user has an account to be allowed to add a comment
            require("view/frontend/formCommentView.php");
        } else {
            echo "Se connecter ou créer un compte pour ajouter un commentaire";
        }
    } else {
        require("view/frontend/signupModalView.php");
    }
}

// Articles Section

// Default Page -> List all posts from the most recent to the oldest
function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts();
    // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}


// Pagination
function pagination()
{
    $postManager = new PostManager();
    $postManager->pagination();
}

// Get and display the post by its Id 
function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}


// Admin Side -> Open Article Form Page
function addArticle()
{
    $postManager = new PostManager();
    $postManager->addArticle();
}

// Admin Side -> Post New Article
function postArticle($author, $title, $content)
{
    $postManager = new PostManager();
    if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['content'])) {
        $postManager->postArticle($author, $title, $content);
        echo '<div class="alert alert-success add_article_msg">Article à été ajouté</div>';
    } else {
        echo '<div class="alert alert-warning add_article_msg">Tous les champs ne sont pas remplis !</div>';
    }
}

// Delete article and its comments (using On Delete Cascade)
function deleteArticle($id)
{
    $postManager = new PostManager();
    $postManager->deleteFromDataBase($id);

    $_SESSION['message'] = "L'article a été supprimé.";
    $_SESSION['msg_type'] = "danger";

    header('Location: index.php#sectionArticles');
}

// Get the Article by its Id and ready to modify
function editArticle()
{
    $postManager = new PostManager();
    $post = $postManager->getPost($_GET['id']);

    require('view/frontend/editPostView.php');
}

// Update the modified article
function updateArticle($id, $author, $title, $content)
{
    $postManager = new PostManager();
    $postManager->updatePost($id, $author, $title, $content);

    $_SESSION['message'] = "L'article a été mis à jour.";
    $_SESSION['msg_type'] = "info";

    header('Location: index.php#sectionArticles');
}

function shortArticle($data)
{
    $textShortened = $data['content'];
    if (strlen($textShortened) > 800) {
        $maxLength = 799;
        $textShortened = substr($textShortened, 0, $maxLength);
    }
    echo  $textShortened . '...';
}

// Comment Section


// Admin Side -> List Comments stored from the most reported..
function listComments()
{
    $commentManager = new CommentManager();
    $comments = $commentManager->listComments();

    require('view/frontend/listCommentsView.php');
}

// Delete Comment
function deleteComment($id)
{
    $commentManager = new CommentManager();
    $commentManager->listComments();
    $commentManager->deleteComment($id);

    $_SESSION['message'] = "Le commentaire à été supprimé";
    $_SESSION['msg_type'] = "danger";

    header('Location: index.php?action=listComments#tableCommentsTitle');
}

// Add Comment to a Post
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


// Signal Comment Increasing its report number ($variable)
function signal($id, $variable, $commentStatus)
{
    $commentManager = new CommentManager();
    $commentManager->signal($id, $variable, $commentStatus);

    $_SESSION['message'] = "L'article a été signalé.";
    $_SESSION['msg_type'] = "warning";

    header('Location: index.php?action=post&id=' . $_GET['id'] . '#commentBox');
}

// Validate comment by setting its report number to 0
function validateComment($id)
{
    $commentManager = new CommentManager();
    $commentManager->validateComment($id);

    header('Location: index.php?action=listComments#tableCommentsTitle');

    $_SESSION['message'] = "Le commentaire à été validé";
    $_SESSION['msg_type'] = "info";
}

function signalComment($comment)
{
    if ($comment['comment_status'] == 0)
        // Increase the variable report Onclick to signal the comment
        {
            echo $comment['report'] + 1;
        } else {
        $comment['report'];
    }
}
