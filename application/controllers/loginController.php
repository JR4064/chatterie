<?php

try {
    // on vérifie que les champs sont remplis
    if (empty($_POST['email']) || empty($_POST['password']))
        throw new DomainException("Tous les champs doivent être complétés");

    // on vérifie si l'on peut connecter l'utilisateur, si c'est bon, les données de celui-ci
    // sont enregistrés dans $user_infos
    $userModel = new UserModel();
    $user_infos = $userModel->login($_POST['email'], $_POST['password']);

    // puisque la connection est possible, on va enregistrer les infos utilisateur
    // dans $_SESSION pour une réutilisation future
    $userSession = new UserSession();
    $userSession->create($user_infos['id'], $_POST['email'], $user_infos['fullname'], $user_infos['userLevel']);

    // on redirige l'utilisateur pour éviter de renvoyer le formulaire,
    // et charger la vue en mode connecté

    header('location:index.php');

} catch (DomainException $exception){

    // Si la moindre erreur se produit pendant l'execution du try, on est renvoyé
    // vers le formulaire de login, il faut donc récupérer les champs du LoginForm
    $message=$exception->getMessage();

}

