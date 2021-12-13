<?php
require('./master.inc.php');

/**
 * Description: To signup doctor 
 */

if($isLoggedIn){
    exit(Respond::ALIE());
}


$firstname = isset($_POST["firstname"])?Utility::sanitizeString($_POST["firstname"]): null;
$lastname = isset($_POST["lastname"])? Utility::sanitizeString($_POST["lastname"]): null;
$password = isset($_POST['password'])? $_POST['password']:null;
$hospital = isset($_POST['hospital'])? Utility::sanitizeString($_POST['hospital']):null;
$specialization = Utility::sanitizeString($_POST["specialization"]);

$newDoctor = new Doctor();
$newDoctor->setFirstName($firstname);
$newDoctor->setLastName($lastname);
$newDoctor->setPassword($password);
$newDoctor->setHospital($hospital);
$newDoctor->setSpecialization($specialization);

exit($newDoctor->register());

?>