<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#myTextArea'
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Tutorial Php CRUD</title>
</head>

<body>
    <div class="col-md-6 justify-content-center">
        <h1>Mon super blog !</h1>
        <?php
        while ($data = $posts->fetch()) {
            ?>
            <div class="news mb-4 mt-4">
                <h4>
                    <?= htmlspecialchars($data['title']) ?>
                    <em>le <?= $data['creation_date_fr'] ?></em>
                </h4>
                <div>
                    <?= nl2br(htmlspecialchars($data['content'])) ?>
                    <p>
                        <?= nl2br(htmlspecialchars($data['author'])) ?>
                    </p>
                    <em><a href="post.php?id=<?= $data['id'] ?>">Commentaires</a></em>
                </div>
            </div>
        <?php
    }
    $posts->closeCursor();
    ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>