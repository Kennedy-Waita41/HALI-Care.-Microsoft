<?php
require('./master.inc.php');
require(__DIR__. "/../doctor/auth.inc.php");

/**
 * Description: lists consultations for a doctor based on the status and requires the session token (logged in) 
 */

    $interval = (int)$_POST["interval"];
    $page = (int)$_POST["page"];
    $selfAssigned = boolval((int)$_POST['selfAssigned']);
    $status = (int)$_POST["status"];

    if($status < Consultation::CONSULT_PENDING || $status > Consultation::CONSULT_COMPLETE){
        $status = Consultation::CONSULT_PENDING;
    }

    $startPos = $interval * ($page - 1);

    $dbManager = new DbManager();
    $docCond = Doctor::DOC_FOREIGN_ID." = ?";
    $selfAssignedCond = "consult_status = ? and medAssistantId is null and $docCond";
    $notSelfAssignedCond = "consult_status = ? and medAssistantId > 0 and $docCond";
    $pendingCond = "consult_status = ". Consultation::CONSULT_PENDING;

    

    $mainResult = $dbManager->query( 
        Consultation::CONSULT_TABLE." inner join ".Consultation::DOCTOR_CONSULT_TABLE." on ".Consultation::CONSULT_ID." = ".Consultation::CONSULT_FOREIGN_ID, 
        [ Consultation::CONSULT_ID ], 
        ($status === Consultation::CONSULT_PENDING)? $pendingCond : (($selfAssigned) ? $selfAssignedCond : $notSelfAssignedCond ) . " LIMIT $startPos, $interval", 
        ($status == Consultation::CONSULT_PENDING) ? [] : [$status, $globalDoctor->getdoctorId()],
        false,
        true 
        );

        echo $dbManager->getLastQuery();

    if($mainResult === false){
        exit(Respond::SQE());
    }

    $reponse = [
        "consultations" => [],
        "patients" => [],
        "medicalAssistants" => []
    ];

    //consultation ids are all available
    $consultations = [];
    $patients = [];
    $medicalAssistants = [];

    foreach ($mainResult as $idInfo){
        $consultationId = $idInfo["id"];

        $conResult = [];
        $consultation = new Consultation($consultationId);

        $conResult["id"] = $consultation->getConsultationId();
        $conResult["patientId"] = $consultation->getPatientId();
        $conResult["doctorId"] = $consultation->getDoctorId();
        $conResult["symptoms"] = $consultation->getSymptoms()->getSymptoms();

        $patientVitals = [];
        $vitalSigns = $consultation->getVitalSigns();
        $patientVitals["bodyTemp"] = $vitalSigns->getBodyTemperature();
        $patientVitals["respRate"] = $vitalSigns->getRespirationRate();
        $patientVitals["pulseRate"] = $vitalSigns->getPulseRate();
        $patientVitals["bloodPressure"] = $vitalSigns->getBloodPressure();
        $patientVitals["dateAdded"] = $vitalSigns->getCreatedOn();

        $conResult["patientVitals"] = $patientVitals;
        $conResult["dateAdded"] = $consultation->getDateAdded();
        $conResult["dateAssigned"] = $consultation->getDateAssigned();
        $conResult["status"] = $consultation->getConsultationStatus();
        $conResult["medAssistant"] = $consultation->getMedAssistantId();
        $conResult["isAssigned"] = $consultation->isAssigned();
        
        $consultations[] = $conResult;
        unset($conResult);

        $patResult = [];
        $patient = new Patient($consultation->getPatientId());
        $patResult["id"] = $patient->getPatientId();
        $patResult["firstname"] = $patient->getFirstName();
        $patResult["lastname"] = $patient->getLastName();
        $patResult["dob"] = $patient->getDob();
        $patResult["phone"] = $patient->getPhone();
        $patResult["email"] = $patient->getEmail();
        $patResult["profileImageLink"] = $patient->getProfileImage();

        $patients["c".$consultation->getConsultationId()] = $patResult;
        unset($patResult);

        if($consultation->isAssigned() && !empty($consultation->getMedAssistantId())){
            $maResult = [];

            $ma = new MedAssistant($consultation->getMedAssistantId());
            $maResult["id"] = $ma->getMAId();
            $maResult["firstname"] = $ma->getFirstName();
            $maResult["lastname"] = $ma->getLastName();
            $maResult["dob"] = $ma->getDob();
            $maResult["phone"] = $ma->getPhone();
            $maResult["email"] = $ma->getEmail();
            $maResult["profileImageLink"] = $ma->getProfileImage();

            $medicalAssistants["c".$consultation->getConsultationId()] = $maResult;
            unset($maResult);
        }
    }


    $response["consultations"] = $consultations;
    $response["patients"] = $patients;
    $response["medicalAssistants"] = $medicalAssistants;

    exit(Respond::makeResponse(Respond::STATUS_OK, json_encode($response)));
?>