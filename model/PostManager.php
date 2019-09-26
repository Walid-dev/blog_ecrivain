<?php
class PostManager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function addArticle()
    {
        require('view/frontend/addPostView.php');
    }


    public function postArticle($author, $title, $content)
    {
        $db = $this->dbConnect();
        $article = $db->prepare('INSERT INTO posts(author, title, content, creation_date) VALUES(?, ?, ?, NOW())');
        $article->execute(array($author, $title, $content));
    }

    public function deleteFromDataBase($id)
    {
        $db = $this->dbConnect();
        $db->query("DELETE FROM posts WHERE id=$id");
    }

    public function updatePost($id, $author, $title, $content)
    {
        $db = $this->dbConnect();
        $db->query("UPDATE posts SET author='$author' , title='$title', content='$content' WHERE id='$id'");
    }

    private function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');

        return $db;
    }
}
