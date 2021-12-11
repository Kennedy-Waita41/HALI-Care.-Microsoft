<?php
require('./master.inc.php');
require(__DIR__.'/../patient/auth.inc.php');
/**
 * Description: Does what the name suggests and requires the session token (logged in) 
 */

 $consultation = new Consultation();
 $consultation->setPatientId($globalPatient->getPatientId());
 
 exit($consultation->add());
?>