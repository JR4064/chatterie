<?php

//si la page est différente de la page condition qui est statique
//ou que le template chargé est la page d'acceuil on instancie les models

if ($page == "home" || $_GET['page'] != 'condition'){

    $contentModel   = new ContentModel();
    $imageModel = new ImageModel();


    //on vérifie que l'on renvoie bien une catégorie dans l'URL

    if(array_key_exists('categorie', $_GET)){

        //si c'est le cas on récupère le template dans l'URL
        //et on fait appelle aux fonctions générales des models

        $page= $_GET['page'];
        $cats= $contentModel->getContentByCategory($_GET['categorie']);
        $imagesInfo=$imageModel->getImagesByCategory($_GET['categorie']);


        //pour chaque chat
        foreach ($cats as $key => $cat) {

            $cats[$key]['images']=[];

            foreach ($imagesInfo as $image){

                if($cat['id'] == $image['cat_id'])
                    array_push($cats[$key]['images'], $image);

            }
        }
    }

    else{
        //si ce n'est pas le cas on fait appelle à une fonction
        //qui ne renvoie qu'un seul résultat de la BDD
        $cat= $contentModel->getHome();
        $images=$imageModel->getImagesByCategory('accueil');
    }
}