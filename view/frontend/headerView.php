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
        <hr>
    </div>
</header>




    <?php if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyfields") {
          //  echo '<div class="alert alert-danger">Remplir tous les champs.</div>';
            $_SESSION['message'] = "Remplir tous les champs.";
            $_SESSION['msg_type'] = "warning";
        } elseif ($_GET['error'] == "invaliduidmail") {
           // echo '<div class="alert alert-danger" >Pseudo email invalides.</div>';
            $_SESSION['message'] = "Email ou pseudo invalide";
            $_SESSION['msg_type'] = "danger";
        } elseif ($_GET['error'] == "invaliduid") {
          //  echo '<div class="alert alert-danger">Pseudo invalide.</div>';
          $_SESSION['message'] = "Email ou pseudo invalide";
          $_SESSION['msg_type'] = "danger";
        } elseif ($_GET['error'] == "invalidmail") {
           // echo '<div class="alert alert-danger">email non valide.</div>';
           $_SESSION['message'] = "Email invalide";
           $_SESSION['msg_type'] = "danger";
        } elseif ($_GET['error'] == "passwordcheck") {
          //  echo '<div class="alert alert-danger">Les mots de passe ne se correspondent pas.</div>';
            $_SESSION['message'] = "Les mots de passe ne se correspondent pas.";
            $_SESSION['msg_type'] = "warning";
        } elseif ($_GET['error'] == "usertaken") {
         //   echo '<div class="alert alert-danger">Pseudo déja utilisé.</div>';
         $_SESSION['message'] = "Pseudo déja pris.";
         $_SESSION['msg_type'] = "warning";
        } elseif ($_GET['error'] == "emailtaken") {
           // echo '<div class="alert alert-danger">Email déja utilisé.</div>';
           $_SESSION['message'] = "Email déja pris.";
           $_SESSION['msg_type'] = "warning";
        } elseif ($_GET['error'] == "wrongpwd") {
         //   echo '<div class="alert alert-danger">Mot de passe incorrect.</div>';
            $_SESSION['message'] = "Mot de passe incorrect";
            $_SESSION['msg_type'] = "danger";
        }
    } elseif (isset($_GET['login'])) {
       // echo '<div class="alert alert-success">Vous etes maintenant connécté.</div>';
        $_SESSION['message'] = "Vous etes maintenant connécté.";
        $_SESSION['msg_type'] = "success";
    }
    ?>
