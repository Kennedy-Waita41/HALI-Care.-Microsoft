<?php
 require("master.inc.php");

 if($isLoggedIn){
    exit(Respond::ALIE());
 }

 $username = isset($_POST['username'])?$_POST['username']:null;
 $password = isset($_POST['password'])? $_POST['password']:null;

 $user = UserFactory::makeUser($username);
 $user->setUsername($username);
 $user->setPassword($password);
 
 exit($user->login());

?>