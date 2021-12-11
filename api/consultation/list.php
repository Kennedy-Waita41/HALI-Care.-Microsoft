<?php
require('./master.inc.php');
require(__DIR__. "/../doctor/auth.inc.php");

/**
 * Description: lists consultations for a doctor based on the status and requires the session token (logged in) 
 */

    $interval = (int)$_POST["interval"];
    $page = (int)$_POST["page"];
    $selfAssigned = boolval((int)$_POST['selfAssigned']);
    $status = (int)$_POST["status"];

    if($status < Consultation::CONSULT_PENDING || $status > Consultation::CONSULT_COMPLETE){
        $status = Consultation::CONSULT_PENDING;
    }

    $startPos = $interval($page - 1);

    $dbManager = new DbManager();

    $mainResult = $dbManager->query(Consultation::CONSULT_TABLE, [ "*" ], Doctor::DOC_FOREIGN_ID. " = ?", [$globalDoctor->getdoctorId()]);
?>