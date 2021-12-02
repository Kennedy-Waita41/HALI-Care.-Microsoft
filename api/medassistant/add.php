<?php
require('./master.inc.php');

/**
 * Description: signs up a medical assistant 
 */

if($isLoggedIn){
    exit(Respond::ALIE());
}


$firstname = isset($_POST["firstname"])?Utility::sanitizeString($_POST["firstname"]): null;
$lastname = isset($_POST["lastname"])? Utility::sanitizeString($_POST["lastname"]): null;
$password = isset($_POST['password'])? $_POST['password']:null;
$hospital = isset($_POST['hospital'])? Utility::sanitizeString($_POST['hospital']):null;

$newMA = new MedAssistant();
$newMA->setFirstName($firstname);
$newMA->setLastName($lastname);
$newMA->setPassword($password);
$newMA->setHospital($hospital);

exit($newMA->register());

?>