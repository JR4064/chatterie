<?php
include "config.php";

/////////////////// FRONT CONTROLLER /////////////////////////
// C'est l'entité responsable du choix des pages a afficher //
//////////////////////////////////////////////////////////////

$userSession= new UserSession();
$isAdmin=$userSession->isAdmin();
$isLogged=$userSession->isLogged();


// page par defaut
$page = "home";

// on cherche si une page en particulier est demandé
if (array_key_exists('page', $_GET)) {
    $page = $_GET['page'];
}

// si la page n'est pas trouvée on définie la page sur 404.phtml
if (!file_exists("www/$page.phtml")) {
    $page = 404;
}

if (file_exists(CONTROLLER.'/'.$page.'Controller.php')) {
    // chargement des controlleurs
    include CONTROLLER.'/'.$page.'Controller.php';
}else{
    include CONTROLLER.'/catController.php';
}


// chargement des vues
include "www/layout.phtml";