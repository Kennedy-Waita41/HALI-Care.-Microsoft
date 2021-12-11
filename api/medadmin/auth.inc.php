<?php
require(__DIR__.'/../auth.inc.php');

    $globalMedAdmin = UserFactory::makeUser($currentUsername);
    if(! ($globalMedAdmin instanceof MedAdmin)){
        exit(Respond::UTE());
    }

?>