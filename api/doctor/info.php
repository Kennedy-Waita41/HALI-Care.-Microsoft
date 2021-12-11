<?php
require('./master.inc.php');
require('./auth.inc.php');

/**
 * Description: give the doctor information requested and requires the session token (logged in) 
 */

 exit(
     Respond::makeResponse(
         Respond::STATUS_OK,
         json_encode(
             [
                 "id" => $globalDoctor->getdoctorId(),
                 "firstname" => $globalDoctor->getFirstName(),
                 "lastname" => $globalDoctor->getLastName(),
                 "phone" => $globalDoctor->getPhone(),
                 "email" => $globalDoctor->getEmail(),
                 "hospital" => $globalDoctor->getHospital(),
                 "specilization" => $globalDoctor->getSpecialization(),
                 "profileImageLink" => $globalDoctor->getProfileImage(),
             ]
         )
     )
 )

?>