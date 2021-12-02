<?php
require('./master.inc.php');
require('./auth.inc.php');

/**
 * Description: sets the status of a user to either declined, pending, or approved. 
 */

 $username = Utility::sanitizeString($_POST["username"]);
 $newStatus = (int)$_POST["newstatus"];

 $medPrac = UserFactory::makeUser($username);

 if($medPrac instanceof Patient){
     exit(Respond::UEO());
 }
 $result = false;
 switch($newStatus){
     case User::ACCOUNT_APPROVED:
        {
            $result = $admin->approve($medPrac);
            break;
        } 
     case User::ACCOUNT_PENDING: 
        {
            $result = $admin->pend($medPrac);
            break;
        }
     case User::ACCOUNT_DECLINED:
        {
            $result = $admin->decline($medPrac);
            break;
        }
 }

 if(!$result) exit(Respond::UEO());

 exit(Respond::OK());
?>