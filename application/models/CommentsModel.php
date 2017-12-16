<?php


class CommentsModel {

    function getComments($offset=0){
        $db = new Database();

        if ($offset != 0)
            $sqlLimit=' OFFSET '.$offset;
        else
            $sqlLimit='';

        $sql = 'SELECT comments.id, title, comments.content, user_id, post_date 
                FROM comments
                JOIN users ON users.id = comments.user_id   
                ORDER BY comments.id DESC
                LIMIT 10'.$sqlLimit;

        return $db->fetchAll($sql);
    }

    function getTotalComments(){
        $db = new Database();

        return $db->fetch('SELECT count(id) as totalcomments FROM comments ');
    }

    function addComments($title,$contents,$user_Id){
        $db = new Database();

        $sql = 'INSERT INTO comments(title, content, user_id, post_date) VALUES (?,?,?,now())';

        return $db->execute($sql,[$title,$contents,$user_Id]);
    }

    function updateComment($title,$contents,$comments_Id){
        $db = new Database();

        $sql='UPDATE comments 
              SET title = ?, content = ?, post_date = ? 
              WHERE id = ?';

        return $db->execute($sql, [$title,$contents,$comments_Id]);
    }
}