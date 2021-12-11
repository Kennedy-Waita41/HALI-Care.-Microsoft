<?php
require(__DIR__.'/../auth.inc.php');

$globalPatient = UserFactory::makeUser($currentUsername);
if(! ($globalPatient instanceof Patient)){
    exit(Respond::UTE());
}
?>