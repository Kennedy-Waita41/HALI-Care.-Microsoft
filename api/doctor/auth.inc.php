<?php
require(__DIR__.'/../auth.inc.php');

    $globalDoctor = UserFactory::makeUser($currentUsername);
    if(! ($globalDoctor instanceof Doctor)){
        exit(Respond::UTE());
    }

    if(!$globalDoctor->isApprovable()){
        exit(Respond::NDCIE());
    }
?>