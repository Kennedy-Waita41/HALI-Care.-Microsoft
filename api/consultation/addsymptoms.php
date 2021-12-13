<?php
require('./master.inc.php');
require('./auth.inc.php');

/**
 * Description: Does what the name suggests and requires the session token (logged in) 
 */

$ticket = Utility::sanitizeString($_POST["ticket"]);
$pat_symptoms = $_POST["symptoms"];
$patUserName = Utility::sanitizeString($_POST["pUsername"]);

$consultationId = Consultation::getIdFromTicket($ticket);

$consultation = new Consultation($consultationId);
$patient = new Patient($consultation->getPatientId());

if(!$patient->canRequest()){
    exit(Respond::NPCIE());
}

if($patient->getPatientId() !== User::getIdFromUserName($patUserName)){
   exit(Respond::CNFPE());
}

if($consultation->getConsultationStatus() == Consultation::CONSULT_COMPLETE){
    exit(Respond::CACE());
}

$symptoms = $consultation->getSymptoms();
$symptoms->setSymptoms($pat_symptoms);


exit($vitalSigns->save());

?>