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

}

?>
      