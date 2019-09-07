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
    <?php require 'process.php' ?>
    <?php if (isset($_SESSION['message'])) : ?>

        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']); ?>
        </div>
    <?php endif ?>

    <div class="container">
        <?php
        $mysqli = new mysqli('localhost', 'root', 'root', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        //pre_r($result);
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>
                            <a href="index.php?edit=<?= $row['id'] ?>" class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>

                        </td>
                    </tr>
                <?php endwhile;          ?>
            </table>
        </div>

        <?php
        pre_r($result->fetch_assoc());

        function pre_r($array)
        {
            echo '
           <pre>';
            print_r($array);
            echo '</pre>';
        }

        ?>
        <div class="row justify-content-center">
            <form action="process.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label>Name :</label>
                </div>
                <input id="myTextArea" class="form-control" type="text" name="name" value="<?php echo $name ?>" placeholder="Enter your name">
                <div class="form-group">
                    <label>Location :</label>
                    <input class="form-control" type="text" name="location" value="<?php echo $location ?>" placeholder="Enter your location">
                </div>
                <div class="form-group">
                    <?php if ($update == true) :
                        ?>
                        <button class="btn btn-info" type="submit" name="update">Update</button>
                    <?php else : ?>
                        <button class="btn btn-primary" type="submit" name="save">Save</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>