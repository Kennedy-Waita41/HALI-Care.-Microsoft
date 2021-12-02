<?php
    require("master.inc.php");
    require("auth.inc.php");
    
    $code = isset($_POST["code"])?$_POST["code"] : null;
    $user = new User();
    $user->setId($userId);

    if($code !== null){
        exit($user->confirmEmail($code));
    }

    exit(Respond::UEO());

?>