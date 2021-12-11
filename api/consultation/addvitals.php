<?php
require('./master.inc.php');
require('./auth.inc.php');

/**
 * Description: Does what the name suggests 
 */

 $ticket = Utility::sanitizeString($_POST["ticket"]);
 $bloodPressure = (float)$_POST["bloodPressure"];
 $bodyTemp = (float)$_POST["bodyTemp"];
 $pulseRate = (float)$_POST["pulseRate"];
 $respRate = (float)$_POST["respRate"];
 $patUserName = Utility::sanitizeString($_POST["pUsername"]);

 $consultationId = Consultation::getIdFromTicket($ticket);

 $consultation = new Consultation($consultationId);
 $patient = new Patient($consultation->getPatientId());

 if(!$patient->canRequest()){
     exit(Respond::NPCIE());
 }

 if($patient->getId() !== User::getIdFromUserName($patUserName)){
    exit(Respond::CNFPE());
 }

 if($consultation->getConsultationStatus() == Consultation::CONSULT_COMPLETE){
     exit(Respond::CACE());
 }

 $vitalSigns = $consultation->getVitalSigns();
 $vitalSigns->setBloodPressure($bloodPressure);
 $vitalSigns->setRespirationRate($respRate);
 $vitalSigns->setBodyTemperature($bodyTemp);
 $vitalSigns->setPulseRate($pulseRate);

 exit($vitalSigns->save());
?>