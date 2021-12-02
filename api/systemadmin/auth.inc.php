<?php
require(__DIR__.'/../auth.inc.php');

/**
 * Checks if this person is an Admin
 */
 $admin = UserFactory::makeUser($username);
 if(!($admin instanceof SystemAdmin)){
     exit(Respond::UTE());
 }
?>