<?php
require('./master.inc.php');
require('./auth.inc.php');

/**
 * Description: To signup medical administrator 
 */

if($isLoggedIn){
    exit(Respond::ALIE());
}


$firstname = isset($_POST["firstname"])?Utility::sanitizeString($_POST["firstname"]): null;
$lastname = isset($_POST["lastname"])? Utility::sanitizeString($_POST["lastname"]): null;
$password = isset($_POST['password'])? $_POST['password']:null;
$hospital = isset($_POST['hospital'])? Utility::sanitizeString($_POST['hospital']):null;

$newMedAdmin = new MedAdmin();
$newMedAdmin->setFirstName($firstname);
$newMedAdmin->setLastName($lastname);
$newMedAdmin->setPassword($password);
$newMedAdmin->setHospital($hospital);

exit($newMedAdmin->register());

?>