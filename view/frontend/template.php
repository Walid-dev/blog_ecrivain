<?php  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        tinymce.init({
            selector: '#myTextArea',

        });
    </script>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/footer.css">

    <title>"Billet simple pour l'Alaska"</title>
</head>

<body>

    <?php require "view/frontend/headerView.php" ?>

    <body>
        <div class="main_wrapper">
            <?php if (isset($_SESSION['message'])) : ?>
                <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                    <?php echo $_SESSION['message'];
                    unset($_SESSION['message']); ?>
                </div>
            <?php endif ?>
            <?= $content ?>
        </div>

        <?php require "view/frontend/footerView.php" ?>
        <script src="public/js/app.js"></script>
        <script src="public/js/scroll-out.js"></script>
        <script type="text/javascript">
            ScrollOut({
                targets: 'h2,h3,p,a,blockquote,.masthead_title,.alert'
            })
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>

</html>