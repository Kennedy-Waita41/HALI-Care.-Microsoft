<?php
require('./master.inc.php');

/**
 * Description: lists consultations for a doctor based on the status and requires the session token (logged in) 
 */

    $interval = (int)$_POST["interval"];
    $page = (int)$_POST["page"];
    $specialization = isset($_POST["specialization"]) ? $_POST["specialization"] : null;
    $hospital = isset($_POST["hospital"]) ? $_POST["hospital"] : null;

    $startPos = $interval * ($page - 1);

    $dbManager = new DbManager();
    if($specialization && $hospital){
        $condition = "specialization = ? and hospital = ?";
        $values = [$specialization, $hospital];
    }else if($specialization){
        $condition = "specialization = ?";
        $values = [$specialization];
    }else if($hospital){
        $condition = "hospital = ?";
        $values = [$hospital];
    }else{
        $condition = "1";
        $values = [];
    }
     

    $mainResult = $dbManager->query( 
        Doctor::DOC_TABLE." inner join ".User::USER_TABLE." on ".User::USER_FOREIGN_ID." = ".User::USER_ID, 
        [ Doctor::DOC_ID ], 
        $condition . " LIMIT $startPos, $interval", 
        $values,
        false,
        true 
        );

    if($mainResult === false){
        exit(Respond::SQE());
    }

    $reponse = [
        "doctors" => []
    ];

    //doctor ids are all available
    $doctors = [];

    foreach ($mainResult as $idInfo){
        $doctorId = $idInfo["id"];

        $docResult = [];
        $doctor = new Doctor($doctorId);

        $docResult["id"] = $doctor->getdoctorId();
        $docResult["firstname"] = $doctor->getFirstName();
        $docResult["lastname"] = $doctor->getLastName();
        $docResult["phone"] = $doctor->getPhone();
        $docResult["hospital"] = $doctor->getHospital();
        $docResult["specialization"] = $doctor->getSpecialization();

        $doctors = $docResult;
        unset($docResult);
    }


    $response["doctors"] = $doctors;

    exit(Respond::makeResponse(Respond::STATUS_OK, json_encode($response)));
?>