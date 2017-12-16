<?php



$isAdmin = true;

if(array_key_exists('addCat', $_POST)){

    $cat_name = $_POST['name'];
    $description= $_POST['description'];
    $category_id= $_POST['category_id'];

    $catModel = new ContentModel();

    $imageModel= new ImageModel();

    $catModel->addCat($cat_name, $description, $category_id);

}