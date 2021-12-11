<?php
require('./master.inc.php');
require('./auth.inc.php');

/**
 * Description: gives the information whose ticket is given and requires the session token (logged in) 
 */
    $ticket = isset($_POST["ticket"])? Utility::sanitizeString($_POST["ticket"]): exit(Respond::NCFE());

    $consultation = new Consultation(Consultation::getIdFromTicket($ticket));
    $patient = new Patient($consultation->getPatientId());
    $symptoms = $consultation->getSymptoms();
    $vitalSigns = $consultation->getVitalSigns();

    $response = [];
    $response["consultation"] = [
        "id" => $consultation->getConsultationId(),
        "patientId" => $consultation->getPatientId(),
        "doctorid" => $consultation->getDoctorId(),
        "medAssistantId" => $consultation->getMedAssistantId(),
        "symptoms" => $symptoms->getSymptoms(),
        "vitalSigns" => [
            "bloodPressure" => $vitalSigns->getBloodPressure(),
            "respRate" => $vitalSigns->getRespirationRate(),
            "bodyTemp" => $vitalSigns->getBodyTemperature(),
            "pulseRate" => $vitalSigns->getPulseRate()
        ],
        "dateAdded" => $consultation->getDateAdded(),
        "dateAssigned" => $consultation->getDateAssigned(),
        "isAssigned" => $consultation->isAssigned()
    ];

    $response["patient"] = [
        "id" => $patient->getPatientId(),
        "firstname" => $patient->getFirstName(),
        "lastname" => $patient->getLastName(),
        "email" => $patient->getEmail(),
        "phone" => $patient->getPhone(),
        "dob" => $patient->getDob()
    ];

    if($consultation->isAssigned()){
        $doctor = new Doctor($consultation->getDoctorId());
        $response["doctor"] = [
            "id" => $doctor->getDoctorId(),
            "firstname" => $doctor->getFirstName(),
            "lastname" => $doctor->getLastName(),
            "hospital" => $doctor->getHospital(),
            "specialization"=>$doctor->getSpecialization(),
            "email" => $doctor->getEmail(),
            "phone" => $doctor->getPhone(),
            "dob" => $doctor->getDob()
        ];

        if(!empty($consultation->getMedAssistantId())){
            $ma = new MedAssistant($consultation->getMedAssistantId());
            $response["medicalAssistant"] = [
                "id" => $ma->getMAId(),
                "firstname" => $ma->getFirstName(),
                "lastname" => $ma->getLastName(),
                "hospital" => $ma->getHospital(),
                "email" => $ma->getEmail(),
                "phone" => $ma->getPhone(),
                "dob" => $ma->getDob()
            ]; 
        }
    }

    exit(Respond::makeResponse(
        Respond::STATUS_OK,
        json_encode(
            $response
        )
        ));

?>