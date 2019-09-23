<?php require "view/frontend/headerView.php" ?>

<main>
    <div class="container">
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <header class="card-header">
                        <a href="" class="float-right btn btn-outline-primary mt-1">Se Connecter</a>
                        <h4 class="card-title mt-2">Créer Votre Compte</h4>
                    </header>
                    <article class="card-body">
                        <form action="index.php" method="post">
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Pseudo</label>
                                    <input type="text" class="form-control" name="uid" placeholder="Pseudo">
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" name="mail" placeholder="E-mail">
                                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Votre Mot de passe</label>
                                <input class="form-control" type="password" name="pwd" placeholder="Mot de passe">
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Répeter Mot de passe</label>
                                <input class="form-control" type="password" name="pwd-repeat" placeholder="Répeter Mot de passe">
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" name="signup-submit"> Créer </button>
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <?php if (isset($_GET['error'])) {
                                    if ($_GET['error'] == "emptyfields") {
                                        echo '<p class="signup_error">Remplir tous les champs.</p>';
                                    } elseif ($_GET['error'] == "invaliduidmail") {
                                        echo '<p class="signup_error">Pseudo t email invalides.</p>';
                                    } elseif ($_GET['error'] == "invaliduid") {
                                        echo '<p class="signup_error">Pseudo invalide.</p>';
                                    } elseif ($_GET['error'] == "invalidmail") {
                                        echo '<p class="signup_error">email non valide.</p>';
                                    } elseif ($_GET['error'] == "passwordcheck") {
                                        echo '<p class="signup_error">Les mots de passe ne se correspondent pas.</p>';
                                    } elseif ($_GET['error'] == "usertaken") {
                                        echo '<p class="signup_error">Pseudo déja utilisé.</p>';
                                    } elseif ($_GET['signup'] == "success") {
                                        echo '<p class="signup_success">Vous etes maintenant connécté.</p>';
                                    }
                                }
                                ?>
                            </div>
                        </form>
                    </article> <!-- card-body end .// -->
                    <div class="border-top card-body text-center">Vous avez un compte? <a href="index.php">Se connecter</a></div>
                </div> <!-- card.// -->
            </div> <!-- col.//-->

        </div> <!-- row.//-->


    </div>
</main>

<?php require "view/frontend/footerView.php" ?>