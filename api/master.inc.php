<?php

/**
 * This file must only be called by the children master.inc.php in each folder
 */

require(__DIR__."/../vendor/autoload.php");

/** 
 * Include classes as needed as needed
 */

spl_autoload_register(function($name){
   $classname = strtolower($name);
   $filename = __DIR__. "/classes/$classname.class.php";
   if(file_exists($filename)){
      include($filename);
   }
});


 $isLoggedIn = false;
 $userId = 0; //global user Id from the user table
 $specificId = 0; //global Id from the specific-user table such as patient, doctor, etc.
 $currentUsername = "";
 $globalUserType = "";
 $sessionId;
 //checking if the user is logged in.

 if(isset($_SERVER["HTTP_AUTH"])){
   $auth = $_SERVER["HTTP_AUTH"];
   $auth = preg_split("/-/", $auth);

   if(count($auth) < 3){
      $auth = [0, "", "PAT"];
   }

   $id = $auth[0];
   $token = $auth[1];
   $appendTo = $auth[2];
   $currentUsername = User::generateUserName($id, $appendTo);
   $anyUser = UserFactory::makeUser($currentUsername);

   $dbManager = new DbManager();
   $result = $dbManager->query(User::SESSION_TABLE, [User::SESSION_ID, User::USER_FOREIGN_ID], "session_token = ? and ".User::USER_FOREIGN_ID." = ?", [$token, $anyUser->getId()]);


   if($result !== false){
      $userId = $result[User::USER_FOREIGN_ID];
      $specificId = $id;
      $globalUserType = $appendTo;
      $sessionId = $result[User::SESSION_ID];
      $isLoggedIn = true;
   }

   $dbManager->close();
 }

 //we only get data in json format
//  $request = json_decode(file_get_contents("php://input")); for later

?>