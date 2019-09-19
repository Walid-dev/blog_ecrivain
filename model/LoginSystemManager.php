<?php

class LoginSystemManager
{

    public function signup()
    {


        $serverName = "localhost";
        $dbUsername = "root";
        $dbPassword = "root";
        $dbName = "blog";

        $conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }


        $username = $_POST['uid'];
        $email = $_POST['mail'];
        $password = $_POST['pwd'];
        $passwordRepeat = $_POST['pwd-repeat'];

        if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
            header("Location: signup.php?error=emptyfields&uid=" . $username . "&mail=" . $email);
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: signup.php?error=invalidmailuid=");
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: signup.php?error=invalidmail&uid=" . $username);
            exit();
        } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: signup.php?error=invaliduid&mail=" . $email);
            exit();
        } elseif ($password !== $passwordRepeat) {
            header("Location: signup.php?error=passwordcheck&uid=" . $username . "&mail=" . $email);
            exit();
        } else {
            $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: signup.php?error=sqlerror2");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0) {
                    header("Location: signup.php?error=usertaken&mail= . $email");
                    exit();
                } else {
                    $sql = "INSERT INTO users (uidUsers , emailUsers, pwdUsers) VALUE (?, ?, ?) ";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: signup.php?error=sqlerror3");
                        exit();
                    } else {

                        $hachedPwd = password_hash($password, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hachedPwd);
                        mysqli_stmt_execute($stmt);

                        header("Location: signup.php?signup=success");

                        exit();
                    }
                }
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }


    private function dbLogin()
    { }
}
