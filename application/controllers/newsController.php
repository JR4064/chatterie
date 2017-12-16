<?php

if (array_key_exists('page', $_GET)){

    $imageModel = new ImageModel();
    $contentModel   = new ContentModel();

    $news = $contentModel->getContentByCategory($_GET['page']);
    $imagesInfo = $imageModel->getImagesByCategory($_GET['page']);

}