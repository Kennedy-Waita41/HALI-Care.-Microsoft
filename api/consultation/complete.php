<?php
require('./master.inc.php');
require(__DIR__.'/../doctor/auth.inc.php');

/**
 * Description: changes the status of a consultation to completed. and requires the session token (logged in) 
 */

 $ticket = Utility::sanitizeString($_POST["ticket"]);

 $consultation = new Consultation(Consultation::getIdFromTicket($ticket));

 if($consultation->getDoctorId() !== $specificId){
     exit(Respond::DNATCE());
 }

 $consultation->complete() ? exit(Respond::OK()) : Respond::SQE();
?>