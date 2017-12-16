<?php


class ContentModel {

    function getContentByCategory($category_name){
        $db = new Database();
        $sql = 'SELECT contents.id, title, contents.presentation, category_id 
                                FROM contents
                                JOIN categories ON categories.id = contents.category_id
                                WHERE category_name= ?
                                ORDER BY contents.id';
        return $db->fetchAll($sql,[$category_name]);
    }


    function getHome(){
        $db = new Database();
        $sql = 'SELECT contents.id, title, presentation, category_id 
                                FROM contents
                                JOIN categories ON categories.id = contents.category_id
                                WHERE category_id = ?
                                ';
        return $db->fetch($sql,['1']);
    }


    function updateContent($cat_name, $description, $category_id, $cat_id){
        $db = new Database();
        return $db->execute('UPDATE contents 
                                 SET title = ?, presentation = ?, category_id = ? 
                                 WHERE id = ?', [$cat_name, $description, $category_id, $cat_id]);
    }

    function addContent($cat_name, $description, $category_id){

        $sql = "INSERT INTO contents (title, presentation, category_id) VALUES (?,?,?)";

        $db = new Database();
        return $db->execute($sql, [$cat_name, $description, $category_id]);
    }


}