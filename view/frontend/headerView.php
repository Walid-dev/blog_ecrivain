<header id="home" class="masthead">
    <nav class="navbar navbar-expand-lg d-flex d-flex justify-content-between">
        <a class="navbar-brand" href="#">
            <img src="https://media.giphy.com/media/OqAeQrRDGhKc4Viqfj/giphy.gif" width="70" height="70" alt="">
        </a>

        <div class="">
            <?php
            if (isset($_SESSION['userId'])) {
                require "view/frontend/logModalView.php";
            } else {
                require "view/frontend/signupModalView.php";
            }
            ?>
        </div>
    </nav>
    <div class="title_box text-center mt-2 mb-2">
        <hr>
        <h1 class="masthead_title">"Billet simple pour l'Alaska"</h1>
        <h2 class="masthead_author_name">Jean Forteroche</h2>
        <?php if (isset($_SESSION['userUid'])) {
            echo   "<h3>Bonjour "  . $_SESSION['userUid'] . "</h3>";
        } ?>
        <hr>
    </div>
</header>



<div class="box_login_errors text-center">
    <?php if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyfields") {
            echo '<div class="alert alert-danger">Remplir tous les champs.</div>';
        } elseif ($_GET['error'] == "invaliduidmail") {
            echo '<div class="alert alert-danger">Pseudo email invalides.</div>';
        } elseif ($_GET['error'] == "invaliduid") {
            echo '<div class="alert alert-danger">Pseudo invalide.</div>';
        } elseif ($_GET['error'] == "invalidmail") {
            echo '<div class="alert alert-danger">email non valide.</div>';
        } elseif ($_GET['error'] == "passwordcheck") {
            echo '<div class="alert alert-danger">Les mots de passe ne se correspondent pas.</div>';
        } elseif ($_GET['error'] == "usertaken") {
            echo '<div class="alert alert-danger">Pseudo déja utilisé.</div>';
        } elseif ($_GET['error'] == "emailtaken") {
            echo '<div class="alert alert-danger">Email déja utilisé.</div>';
        } elseif ($_GET['error'] == "wrongpwd") {
            echo '<div class="alert alert-danger">Mot de passe incorrect.</div>';
        }
    } elseif (isset($_GET['login'])) {
        echo '<div class="alert alert-success">Vous etes maintenant connécté.</div>';
    }
    ?>
</div>