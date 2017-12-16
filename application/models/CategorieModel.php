<?php
/**
 * Created by PhpStorm.
 * User: nodj
 * Date: 16/12/2017
 * Time: 10:32
 */

class CategorieModel {

    function getCategories(){
        $db = new Database();

        $categories=$db->fetchAll('SELECT category_name, id
                              FROM categories');

        return $categories;
    }
}