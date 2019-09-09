<?php
class PostManager
{
    public function postPost()
    {
        $mysqli = $this->dbConnect();
        $title = $_POST['title'];
        $author = $_POST['author'];
        $content = $_POST['content'];
        $req = $mysqli->query("INSERT INTO posts (title, content, author, creation_date) VALUES('$title', '$content', '$author', NOW())")
            or die($mysqli->error);

        return $req;
    }

    private function dbConnect()
    {
        $mysqli = new mysqli('localhost', 'root', 'root', 'blog') or die(mysql_error($mysqli));
        return $mysqli;
    }
}
