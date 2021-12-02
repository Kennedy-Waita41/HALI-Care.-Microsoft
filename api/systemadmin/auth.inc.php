<?php
require(__DIR__.'/../auth.inc.php');

/**
 * Checks if this person is an Admin
 */
 $user = UserFactory::makeUser($username);
 if(!($user instanceof SystemAdmin)){
     exit(Respond::UTE());
 }
?>