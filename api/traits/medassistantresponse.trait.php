<?php 
/**
 * MedAssistantResponseTrait
 */ 


trait MedAssistantResponseTrait{

    /**
     * No Hospital Error
     */
    public static function NHE(){
        return Response::makeResponse("NHE", "Please add the hospital/clinic/facility at which you work");
    }

    /**
     * Unqualified Hospital Name Error
     */
    public static function UQHNE(){
        return Respond::makeResponse("UQHNE", "Your workplace name has unacceptable characters.");
    }
}

?>
      