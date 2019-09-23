<?php require "headerView.php" ?>

<body>
    <div class="main_wrapper">
        <div class="box_login_msg">
            <?php
            if (isset($_SESSION['userId'])) {
                echo '<p class="text-center mt-3 mb-3">You are logged in!</p>';
            } else {
                echo '<p class="text-center mt-3 mb-3">You are logged out!</p>';
            }
            ?>
        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>