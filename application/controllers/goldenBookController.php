<?php

if (array_key_exists('page', $_GET)){

    $userSessionModel = new UserSession();
    $commentsModel   = new CommentsModel();

    $comments = $commentsModel->getComments();

    $userInfo = [
        'userid'    => $userSessionModel -> get_user_id(),
        'fullname'  => $userSessionModel -> getFullName()
        ];
}