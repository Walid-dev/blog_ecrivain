<header class="masthead">
    <nav class="navbar navbar-expand-lg d-flex d-flex justify-content-between">
        <a class="navbar-brand" href="#">
            <img src="public/images/logo.png" width="40" height="40" alt="">
        </a>

        <div>
            <?php
            if (isset($_SESSION['userId'])) {
                require "view/frontend/logModalView.php";
            } else {
                require "view/frontend/signupModalView.php";
            }
            ?>
        </div>
    </nav>

    <div class="">
        <?php
        if (isset($_SESSION['userId'])) {
            echo '<p class="online_msg_green mr-4">Connecté</p>';
        } else {
            echo '<p class="online_msg_red mr-4">Deconnecté</p>';
        }
        ?>
    </div>


</header>



<div class="box_login_errors text-center">
    <?php if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyfields") {
            echo '<div class="alert alert-danger">Remplir tous les champs.</div>';
        } elseif ($_GET['error'] == "invaliduidmail") {
            echo '<div class="alert alert-danger">Pseudo t email invalides.</div>';
        } elseif ($_GET['error'] == "invaliduid") {
            echo '<div class="alert alert-danger">Pseudo invalide.</div>';
        } elseif ($_GET['error'] == "invalidmail") {
            echo '<div class="alert alert-danger">email non valide.</div>';
        } elseif ($_GET['error'] == "passwordcheck") {
            echo '<div class="alert alert-danger">Les mots de passe ne se correspondent pas.</div>';
        } elseif ($_GET['error'] == "usertaken") {
            echo '<div class="alert alert-danger">Pseudo déja utilisé.</div>';
        } elseif ($_GET['error'] == "wrongpwd") {
            echo '<div class="alert alert-danger">mauvais mdp</div>';
        } elseif ($_GET['signup'] == "success") {
            echo '<div class="alert alert-success">Vous etes maintenant connécté.</div>';
        }
    }
    ?>
</div>