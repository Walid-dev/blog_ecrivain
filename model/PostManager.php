<?php
class PostManager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }



    private function dbConnect()
    {
        $db = new mysqli('localhost', 'root', 'root', 'blog') or die(mysql_error($mysqli));

        return $db;
    }
}
