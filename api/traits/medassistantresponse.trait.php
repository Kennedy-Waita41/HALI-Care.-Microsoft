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

    /**
     * No MA Contact Info Error
     */
    public static function NMACIE(){
        return Response::makeResponse("NMACIE", "Medical Assistant phone number, email, and place of work must be added to perform this function. Please update profile");
    }

    /**
     * No Doctor Contact Info Not Set Error
     */
    public static function DCINSE(){
        return Response::makeResponse("DCINSE", "The doctor you are trying to assign hasn't added their contact info or place of work yet. Please inform them to.");
    }
}

?>
      