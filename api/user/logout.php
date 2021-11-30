<?php
 require("master.inc.php");
 require("auth.inc.php");

 $user = new User();
 $user->setId($userId);
 $user->setSessionId($sessionId);
 exit($user->logout());

?>