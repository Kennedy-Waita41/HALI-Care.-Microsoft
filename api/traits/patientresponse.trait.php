<?php 
/**
 * PatientResponseTrait
 */ 


trait PatientResponseTrait{

    /**
     * No Patient Contact Info Error
     */
    public static function NPCIE(){
        return Response::makeResponse("NPCIE", "Patient phone number or email must be added to perform this function. Please update profile");
    }
}

?>
      