<?php
require('./master.inc.php');
require('./auth.inc.php');

/**
 * Description: return the patient profile information and requires the session token (logged in) 
 */


 exit(
     Respond::makeResponse(Respond::STATUS_OK,
        json_encode(
                [
                    "id" => $globalPatient->getPatientId(),
                    "firstname" => $globalPatient->getFirstName(),
                    "email" => $globalPatient->getEmail(),
                    "phone" => $globalPatient->getPhone(),
                    "dob" => $globalPatient->getDob(),
                    "profileImageLink" => $globalPatient->getProfileImage(),
                    "message" => Respond::MSG_SUCCESS
                ]
            )
        )
    );



?>