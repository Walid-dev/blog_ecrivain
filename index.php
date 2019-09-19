<?php

require('controller/frontendController.php');

try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
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
        } elseif ($_GET['action'] == 'addArticle') {
            addArticle();
            if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['content'])) {
                if (isset($_POST['save'])) {
                    postArticle($_POST['author'], $_POST['title'], $_POST['content']);
                }
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        } elseif ($_GET['action'] == 'delete') {
            deleteArticle($_GET['id']);
        } elseif ($_GET['action'] == 'edit') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                editArticle();
            }
        } elseif (isset($_POST['update'])) {
            updateArticle($_GET['id'], $_POST['author'], $_POST['title'], $_POST['content']);
        } elseif ($_GET['action'] == 'signup') {
            getSigned();
            if (isset($_POST['signup-submit'])) {
                echo "Hello";
                signup();
            } else {
                //   header("Location: index.php?action=signup");
                exit();
            }
        }
    } else {
        listPosts();
    }
} catch (Exception $e) { // S'il y a eu une erreur, alors...
    //  require('view/frontend/errorView.php');
    echo 'Erreur : ' . $e->getMessage();
}
