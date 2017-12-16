<?php


$userSession = new UserSession();
$userSession->destroy();
header('location:index.php');