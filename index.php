<?php
session_start();
require('controller/frontendController.php');

try {
    if (isset($_POST['login-submit'])) {
        login();
    } elseif (isset($_POST['signup-submit'])) {
        addUser();
    } elseif (isset($_POST['signal'])) {
        signal($_POST['commentId'], $_POST['report'], $_POST['commentStatus']);
    } elseif (isset($_POST['logout-submit'])) {
        logout();
    } elseif (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif (isset($_SESSION['userId'])) {

            if ($_SESSION['usertype'] == 2) {
                if ($_GET['action'] == 'addArticle') {
                    addArticle();
                    if (isset($_POST['save'])) {
                        postArticle(strip_tags($_POST['author']), strip_tags($_POST['title']), $_POST['content']);
                    }
                } elseif ($_GET['action'] == 'delete') {
                    deleteArticle($_GET['id']);
                } elseif ($_GET['action'] == 'edit') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        editArticle();
                    } else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                } elseif (isset($_POST['update'])) {
                    updateArticle($_GET['id'], $_POST['author'], $_POST['title'], $_POST['content']);
                } elseif ($_GET['action'] == 'listComments') {
                    listComments();
                } elseif ($_GET['action'] == 'deleteComment') {
                    deleteComment($_GET['id']);
                } elseif ($_GET['action'] == 'validateComment') {
                    validateComment($_GET['id']);
                }
            } else {
                $_SESSION['message'] = "Page reservée aux administrateurs";
                $_SESSION['msg_type'] = "danger";

                listPosts();
            }
        } else {
            $_SESSION['message'] = "Page reservée aux administrateurs";
            $_SESSION['msg_type'] = "danger";

            listPosts();
        }
    } else {
        listPosts();
    }
} catch (Exception $e) { // S'il y a eu une erreur, alors...
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['msg_type'] = "warning";
    listPosts();
}
