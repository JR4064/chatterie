<?php


class ImageModel {


    private $allowExtention =['png', 'jpg', 'jpeg'];

    function getKittenImage($cat_id){
        $db = new Database();
        return $db->fetch('SELECT cat_id, image_url, alt_img 
                            FROM images
                            JOIN contents ON contents.id = images.cat_id
                            WHERE cat_id = ?', [$cat_id]);
    }



    function getImagesByCategory($category_name){
        $db = new Database();

        $imagesInfos=$db->fetchAll('SELECT image_url, alt_img, cat_id
                              FROM images 
                              JOIN categories ON categories.id = images.category_id
                              WHERE category_name = ?', [$category_name]);

        return $imagesInfos;
    }

    function updateImage($image_name , $alt_img, $image_id){
        $db = new Database();
        return $db->execute('UPDATE images SET image_url = ?, alt_img = ? WHERE id = ?', [$image_name, $alt_img, $image_id]);
    }

    function addImages($image_name, $alt_img){

        $sql = "INSERT INTO images (image_url, alt_img) VALUES (?,?)";

        $db = new Database();
        return $db->execute($sql, [$image_name, $alt_img]);
    }

    public function uploadPhoto($file, $categorie, $title){

        if($categorie == 'chatons')
            $storage = IMAGES.'/'.$categorie.'/'.$file['name'];
        else
            $storage = IMAGES.'/'.$title.'/'.$file['name'];

        // si aucune image n'as été envoyé
        if($file['size']==0)
            return NULL;

        // on vérifie que le fichier uploadé possède la bonne extention.
        $ext = explode('.', $file['name']);
        $ext = strtolower($ext[ count($ext)-1 ]);

        if ($file['error'] > 0)
            throw new DomainException("Erreur lors du transfert");

        if(!in_array($ext, $this->allowExtention))
            throw new DomainException("seule les extentions 'png', 'jpg', 'jpeg' sont autorisées");

        if(file_exists($this->$storage))
            throw new DomainException("Ce fichier existe déjà, renomez-le, au pire...");

        if (!move_uploaded_file($file['tmp_name'],$this->$storage))
            throw new DomainException("Erreur lors de la cration du fichier sur le serveur");

        return  $storage;
    }
}