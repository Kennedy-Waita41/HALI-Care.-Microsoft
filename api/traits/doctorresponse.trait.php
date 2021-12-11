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

    /**
     * No Specialization Error
     */
    public static function NSE(){
        return Response::makeResponse("NSE", "Doctor specialiation is required");
    }

    /**
     * Unqualified Specialization Name Error
     */
    public static function UQSNE(){
        return Response::makeResponse("UQSNE", "Your specialization name contains invalid characters");
    }

}

?>
      