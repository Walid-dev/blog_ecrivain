<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.min.css">
    <script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#myTextArea',
        });
    </script>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/footer.css">

    <title>Blog Ecrivain</title>
</head>

<body>

    <header class=" d-flex justify-content-between align-items-center">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="#">
                <img src="public/images/logo.png" width="40" height="40" alt="">
            </a>
        </nav><?php
                if (isset($_SESSION['userId'])) {
                    echo '<form class="form-inline my-2 my-lg-0" action="index.php" method="post">
                    <button class="btn modal_btn mx-3" type="submit" name="logout-submit">Logout</button>
                </form>';
                } else {
                    require "view/frontend/logModalView.php";
                }
                ?>

    </header>

    <header>
        <div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php?action=addArticle">Ajouter article</a>
                        </li>
                    </ul>
                    <?php
                    if (isset($_SESSION['userId'])) {
                        echo '<form class="form-inline my-2 my-lg-0" action="index.php" method="post">
                    <button class="btn btn-sm my-2 my-sm-0" type="submit" name="logout-submit">Logout</button>
                </form>';
                    } else {
                        echo '<form class="form-inline my-2 my-lg-0"  action="index.php" method="post">
                        <input class="form-control form-control-sm mr-sm-2" type="text" name="mailuid" placeholder="Username/E-mail..">
                        <input class="form-control form-control-sm mr-sm-2" type="password" name="pwd" placeholder="Password">
                        <button class="btn btn-sm my-2 my-sm-0" type="submit" name="login-submit">Login</button>
                        <a href="signup.php" class="btn btn-sm ml-2" href="#"> S\'inscrire</a>
                    </form>';
                    }
                    ?>
                </div>
            </nav>
        </div>
    </header>