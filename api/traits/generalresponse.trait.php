<?php 
/** 
 * All general responses are in this trait
 * GeneralResponseTrait
 */ 


trait GeneralResponseTrait{

    /**
     * Programming Error
     * @return string
     */
    public static function PE(){
        return Response::makeResponse(
            "PE",
            "You made a programming error. Either scripts are not included correctly"
        );
    }
    /**
     * Unqualified Type Error
     * @return string
     */
    public static function UTE(){
        return Response::makeResponse(
            "UTE",
            "You don't have the privilege to perform this function"
        );
    }

    /**
     * No ID Error
     * @return string
     */
    public static function NIE(){
        return Response::makeResponse("NIE", "oops! you might not be logged in");
    }

    
    /**
     * Invalid Image Error
     * @return string
     */
    public static function IIE(){
        return Response::makeResponse("IEE", "The image you entered is invalid. Accepted image types are: .jpeg, .png, .gif, .bmp, .webp");
    }

    /**
     * Uknown Error Occurred
     * @return string
     */
    public static function UEO(){
        return Response::makeResponse("UEO", "An unknown error occurred");
    }

    /**
     * General OK
     * @return string
     */
    public static function OK(){
        return Response::makeResponse("OK", "Successfully done");
    }
}

?>
      