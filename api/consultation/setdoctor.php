<?php
require('./master.inc.php');

if($globalUserType === MedAssistant::MA){
    require(__DIR__.'/../medassistant/auth.inc.php');
}
else{
    require(__DIR__. "/../doctor/auth.inc.php");
}

/**
 * Description: this script assigns a doctor to a consultation. This can only be called by a medical assistant or a doctor and requires the session token (logged in) 
 */
    if($globalUserType == Doctor::DOC){
        $docId = $specificId;
        $medId = 0;
    }
    else{
        $docId = (int)$_POST["doctorId"];
        $medId = $specificId;
    }

    $ticket = Utility::sanitizeString($_POST["ticket"]);
    $consultationId = Consultation::getIdFromTicket($ticket);
    $consultation = new Consultation($consultationId);

    if($globalUserType == Doctor::DOC){
        exit($globalDoctor->assignToConsultation($consultation, $medId));
    }

    exit($globalMedAssistant->assignDoctor($consultation, $docId));
?>