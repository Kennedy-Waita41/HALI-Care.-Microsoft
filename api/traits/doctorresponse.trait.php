<?php 
/**
 * DoctorResponseTrait
 */ 


trait DoctorResponseTrait{

    /**
     * No Doctor Contact Info Error
     */
    public static function NDCIE(){
        return Response::makeResponse("NDCIE", "Doctor phone number, email, and place of work must be added to perform this function. Please update profile");
    }

}

?>
      