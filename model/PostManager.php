<?php
class PostManager
{
    public function getPosts()
    {
        $db = $this->dbConnect();

        $req = $db->query('SELECT id FROM posts');
        $articlesCount = $req->rowCount($db);

        $perPage = 4;
        $cPage = 1;
        $nbPages = ceil($articlesCount / $perPage);

        if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPages) {
            $cPage = $_GET['p'];
        } else {
            $cPage = 1;
        }

        $req = $db->query('SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT ' . (($cPage - 1) * $perPage) . ', ' . $perPage . ' ');



        return $req;
    }

    public function display()
    {
        $db = $this->dbConnect();

        $req = $db->query('SELECT id FROM posts');
        $articlesCount = $req->rowCount($db);

        $perPage = 4;
        $cPage = 1;
        $nbPages = ceil($articlesCount / $perPage);

        if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPages) {
            $cPage = $_GET['p'];
        } else {
            $cPage = 1;
        }

        $req = $db->query('SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT ' . (($cPage - 1) * $perPage) . ', ' . $perPage . ' ');



        for ($i = 1; $i <= $nbPages; $i++) {
            if ($i == $cPage) {
                echo "<span>$i</span>";
            } else {
                echo " <a href=\"index.php?p=$i#sectionArticles\">$i</a></a>";
            }
            // echo '<script type="text/javascript">window.onload = function() { document.getElementById("content").innerHTML = "' . $pagination . '"; }</script>';
        }




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
        $db->query("DELETE FROM comments WHERE post_id=$id");
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
