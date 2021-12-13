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

    /**
     * Consultation Not Assignable Error
     */
    public static function CNAE(){
        return Response::makeResponse("CNAE", "There are no recorded symptoms for this consultation");
    }

    /**
     * Consultation Not For Patient Error
     */
    public static function CNFPE(){
        return Response::makeResponse("CNFPE", "The consultation with this ticket doesn't belong to the patient for whom its being updated");
    }

    /**
     * Doctor Not Assigned to Consultation Error
     */
    public static function DNATCE(){
        return Response::makeResponse("DNATCE", "The consultation with this ticket is assigned to another doctor");
    }

}

?>
      