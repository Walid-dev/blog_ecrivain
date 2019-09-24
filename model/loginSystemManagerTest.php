<?php

class LoginSystemManagerTest
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



    public function login()
    {
        $serverName = "localhost";
        $dbUsername = "root";
        $dbPassword = "root";
        $dbName = "blog";

        $conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }


        $mailuid = $_POST['mailuid'];
        $password = $_POST['pwd'];


        if (empty($mailuid) || empty($password)) {
            header("Location: index.php?error=emptyfields");
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE uidUsers=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: index.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $mailuid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    $pwdCheck = password_verify($password, $row['pwdUsers']);

                    if ($pwdCheck == false) {
                        header("Location: index.php?error=wrongpwd");
                        exit();
                    } elseif ($pwdCheck == true) {
                        session_start();
                        $_SESSION['userId'] = $row['idUsers'];
                        $_SESSION['userUid'] = $row['uidUsers'];


                        header("Location: index.php?login=success");
                        exit();
                    } else {
                        header("Location: index.php?error=wrongpwd");
                        exit();
                    }
                } else {
                    header("Location: index.php?error=nouser");
                    exit();
                }
            }
        }
    }
}
