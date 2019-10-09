<?php
class CommentManager
{

    public function listComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, post_id, author, comment, report, comment_status, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments ORDER BY report DESC LIMIT 0, 50');
        return $req;
    }

    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $db->query("DELETE FROM comments WHERE id=$id");
    }

    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, report, comment_status, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, report, comment_status, comment_date) VALUES(?, ?, ?, 0, 0, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }


    public function signal($id, $variable, $commentStatus)
    {
        $db = $this->dbConnect();
        $db->query("UPDATE comments SET report='$variable', comment_status='$commentStatus' WHERE id='$id'");
    }




    private function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
        return $db;
    }
}
