<?php 
/**
 * ConsultationResponseTrait
 */ 


trait ConsultationResponseTrait{

    /**
     * No Consultation Found Error
     */
    public static function NCFE(){
        return Response::makeResponse("NCFE", "No Consultation request was found with using the provided information");
    }

    /**
     * Consultation Already Completed Error
     */
    public static function CACE(){
        return Response::makeResponse("CACE", "You cannot update the consultation with this ticket number, it is already marked as completed");
    }

    /**
     * No Patient ID Found Error
     */
    public static function NPIFE(){
        return Response::makeResponse("NPIFE", "The operation requires a patient to be logged in");
    }

}

?>
      