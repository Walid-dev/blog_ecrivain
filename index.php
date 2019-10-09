<?php
session_start();
require('controller/frontendController.php');

try { // On essaie de faire des choses
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
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif (isset($_SESSION['userId'])) {

            if ($_SESSION['usertype'] == 2) {

                if ($_GET['action'] == 'addArticle') {
                    addArticle();
                    if (isset($_POST['save'])) {
                        if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['content'])) {
                            postArticle(strip_tags($_POST['author']), strip_tags($_POST['title']), $_POST['content']);
                        } else {
                            throw new Exception('Tous les champs ne sont pas remplis !');
                        }
                    }
                } elseif ($_GET['action'] == 'delete') {
                    deleteArticle($_GET['id']);
                } elseif ($_GET['action'] == 'edit') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        editArticle();
                    }
                } elseif (isset($_POST['update'])) {
                    updateArticle($_GET['id'], $_POST['author'], $_POST['title'], $_POST['content']);
                } elseif ($_GET['action'] == 'listComments') {
                    listComments();
                } elseif ($_GET['action'] == 'deleteComment') {
                    deleteComment($_GET['id']);
                }
            } else {
                $_SESSION['message'] = "Page reservée aux administrateurs";
                $_SESSION['msg_type'] = "danger";

                header('Location: index.php');
            }
        } else {
            $_SESSION['message'] = "Page reservée aux administrateurs";
            $_SESSION['msg_type'] = "danger";

            header('Location: index.php');
        }
    } else {
        listPosts();
    }
} catch (Exception $e) { // S'il y a eu une erreur, alors...
    //  require('view/frontend/errorView.php');
    echo 'Erreur : ' . $e->getMessage();
}
