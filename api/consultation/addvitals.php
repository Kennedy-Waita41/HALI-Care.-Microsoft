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

 $consultationId = Consultation::getIdFromTicket($ticket);

 $consultation = new Consultation($consultationId);

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