<?php

if (array_key_exists('page', $_GET)){

    if (array_key_exists('categorie', $_GET)){


        $imageModel = new ImageModel();

        if ($_GET['categorie'] == "disponibles") {

            $contentModel   = new ContentModel();

            $kittenPage = "kittenToAdopt";

            $kittens = $contentModel->getContentByCategory($_GET['categorie']);
            $imagesInfo = $imageModel->getImagesByCategory($_GET['categorie']);

            foreach ($kittens as $key => $kitten) {

                foreach ($imagesInfo as $image) {

                    if ($kitten['id'] == $image['cat_id'])
                        $kittens[$key]['images'] = $image;

                }

            }

        }else if ($_GET['categorie'] == "adoptés") {

            $kittenPage = "kittenBornHome";

            $imagesInfo=$imageModel->getImagesByCategory($_GET['categorie']);

        }
        else{
            header('Location: index.php');
        }
    }
}