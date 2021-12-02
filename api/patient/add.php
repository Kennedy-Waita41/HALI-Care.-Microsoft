<?php
    require('./master.inc.php');

    /**
     * what does this logic script do?
     */
    if($isLoggedIn){
        exit(Respond::ALIE());
    }


    $firstname = isset($_POST["firstname"])?$_POST["firstname"]: null;
    $lastname = isset($_POST["lastname"])?$_POST["lastname"]: null;
    $password = isset($_POST['password'])? $_POST['password']:null;

    $newPatient = new Patient();
    $newPatient->setFirstName($firstname);
    $newPatient->setLastName($lastname);
    $newPatient->setPassword($password);
    
    exit($newPatient->register());
    
?>