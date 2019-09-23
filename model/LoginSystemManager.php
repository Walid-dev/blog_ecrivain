<?php

class LoginSystemManager
{
    public function addUser()
    {
        $db = $this->dbConnect();
        $username = $_POST['uid'];
        $email = $_POST['mail'];
        $password = $_POST['pwd'];
        $passwordRepeat = $_POST['pwd-repeat'];

        if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
            header("Location: index.php?error=emptyfields&uid=" . $username . "&mail=" . $email);
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: index.php?error=invalidmailuid=");
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: index.php?error=invalidmail&uid=" . $username);
            exit();
        } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: index.php?error=invaliduid&mail=" . $email);
            exit();
        } elseif ($password !== $passwordRepeat) {
            header("Location: index.php?error=passwordcheck&uid=" . $username . "&mail=" . $email);
            exit();
        } else {

            $request = $db->prepare("SELECT emailUsers FROM users WHERE emailUsers=?");
            $request->execute(array($email));
            $usernameCheck =  $request->rowCount();
            if ($usernameCheck > 0) {
                header("Location: index.php?error=usertaken&mail= . $username");
                exit();
            } else {

                $hachedPwd = password_hash($password, PASSWORD_DEFAULT);

                $request = $db->prepare('INSERT INTO users (uidUsers , emailUsers, pwdUsers) VALUE (?, ?, ?) ');
                $request->execute(array($username, $email, $hachedPwd));
            }
        }
    }


    public function loginPdo()
    {
        $db = $this->dbConnect();

        $mailuid = $_POST['mailuid'];
        $password = $_POST['pwd'];

        if (empty($mailuid) || empty($password)) {
            header("Location: index.php?error=emptyfields");
            exit();
        } else {

            $stmt = $db->prepare("SELECT * FROM users WHERE emailUsers=?");
            $stmt->execute([$mailuid]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['pwdUsers'])) {
                session_start();
                $_SESSION['userId'] = $user['idUsers'];
                $_SESSION['userUid'] = $user['uidUsers'];
                header("Location: index.php?login=success");
            } else {
                header("Location: index.php?error=wrongpwd");
            }
        }
    }


    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header("Location:index.php");
    }



    private function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
        return $db;
    }
}
