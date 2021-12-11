<?php
require(__DIR__.'/../auth.inc.php');

    $globalMedAssistant = UserFactory::makeUser($currentUsername);
    if(! ($globalMedAssistant instanceof MedAssistant)){
        exit(Respond::UTE());
    }

    if(!$globalMedAssistant->isApprovable()){
        exit(Respond::NMACIE());
    }
?>