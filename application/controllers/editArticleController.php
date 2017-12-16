<?php


$id = '';
$author_id = 0;
$category_id = 0;
$content = "";
$title = "";
$message = "";

// redirection si l'utilisateur n'est pas authentifié
$userSession = new UserSession();
if (!$userSession->isAdmin()) {

    header('Location: index.php');
}


// récupération du formulaire d'édition
if(array_key_exists('save_article', $_POST)){
    extract($_POST);

    // il faut remplir tous les champs
    if(empty($title) || empty($content)){
        $message = "<p>Veuillez remplir tous les champs</p>";

    } else {
        // en mode ajout
        if(empty($id)){



            // en mode édition
        } else {

        }

        // on envoi le tout à la base de données


        header('Location: admin.php');
    }
}


if(array_key_exists('action', $_GET)) {

    switch ($_GET['action']) {
        case "edit":
            $sql = "SELECT id, title, content, category_id, author_id 
                    FROM articles 
                    WHERE id=?
            ";

            $article = fetch($sql, [$_GET['id']]);
            extract($article);

            break;

        case "delete":
            execute("DELETE FROM articles WHERE id = ?", [intval($_GET['id'])]);

            header("Location: admin.php");
            break;
    }
}


$categories = fetchAll('SELECT id, category_name FROM categories');
$authors = fetchAll('SELECT id, author_name FROM authors');


