<?php
require('controller/frontendController.php');

try { // On essaie de faire des choses
    if (isset($_POST['save'])) {
        addPost();
        require('view/frontend/postView.php');
    } else {
        require('view/frontend/template.php');
    }
} catch (Exception $e) { // S'il y a eu une erreur, alors...
    require('view/frontend/errorView.php');
}
