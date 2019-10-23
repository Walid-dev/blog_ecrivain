<form class="form my-2 my-lg-0" action="index.php" method="post">
<?php
                if (isset($_SESSION['usertype'])) {
                    if (($_SESSION['usertype'] == 2)) {
                        require('view/frontend/adminButtonsView2.php');
                    }
                }
                ?>
    <button class="up btn log_btn mr-2 ml-2" type="submit" name="logout-submit">Logout</button>
</form>