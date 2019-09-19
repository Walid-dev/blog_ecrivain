<?php require "view/frontend/headerView.php" ?>


<main>
    <div class="main_wrapper">
        <section class="">
            <h1>Signup</h1>
            <?php
            if (isset($_GET['error'])) {
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
                    # code...
                }
            }
            ?>
            <form action="index.php" method="post">
                <input type="text" name="uid" placeholder="Username">
                <input type="text" name="mail" placeholder="E-mail">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd-repeat" placeholder="Repeat Password">
                <button type="submit" name="signup-submit">Signup</button>
            </form>
        </section>
    </div>
</main>

<?php require "view/frontend/footerView.php" ?>