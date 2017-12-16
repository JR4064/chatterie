<?php

$message='';

try {

    // on vérifie que les champs sont remplis
    if (empty($_POST['email']) || empty($_POST['password']))
        throw new DomainException("Tous les champs doivent être complétés");

    $userModel = new UserModel();
    $user_id = $userModel->create(
        $_POST['firstName'],
        $_POST['lastName'],
        $_POST['email'],
        $_POST['password']
    );

    $userLevel=false;
    $userSession = new UserSession();
    $userSession->create($user_id, $_POST['email'], $userModel->getFullName($user_id), $userLevel);

    header('location:index.php');

} catch (DomainException $exception){

        $message= $exception->getMessage();
}
