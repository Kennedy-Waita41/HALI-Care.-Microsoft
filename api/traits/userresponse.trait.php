<?php 
/** 
* UserResponseTrait
*/ 


trait UserResponseTrait{
  
    /**
     * Wrong Email Error
     * @return string 
     */
    public static function WEE(){
        return Response::makeResponse("WEE", "You entered an invalid credential");
    }

    /**
     * Wrong Password Error
     * @return string
     */
    public static function WPE(){
        return Response::makeResponse("WPE", "You entered an invalid credential");
    }

    /**
     * No Email Error
     * @return string
     */
    public static function NEE(){
        return Response::makeResponse("NEE", "Email is required");
    }

    /**
     * Email Exist Error
     * @return string
     */
    public static function EEE(){
        return Response::makeResponse("EEE", "The email already exist");
    }

    /**
     * Unqualified Email Error
     * @return string
     */
    public static function UEE(){
        return Response::makeResponse("UEE", "The email is invalid");
    }

    /**
     * Unqualified Phone number Error
     * @return string
     */
    public static function UQPNE(){
        return Response::makeResponse("UQPNE", "The phone number you entered is invalid");
    }

    /**
     * Phone Number Exist Error
     * @return string
     */
    public static function PNEE(){
        return Response::makeResponse("PNEE", "The phone number you entered is already attached to another account");
    }

    /**
     * Uqualified Name Error
     * @return string
     */
    public static function UNE(){
        return Response::makeResponse("UNE", "The name contains unaccepted characters");
    }

    /**
     * User Not Found Error
     * @return string
     */
    public static function UNFE(){
        Response::makeResponse("UNFE", "Could not find the user with the given credentials");
    }

    /**
     * Change Password Token Not Found Error
     * @return string
     */
    public static function CPTNFE(){
        return Response::makeResponse("CPTNFE", "You entered the wrong codes");
    }

    /**
     * Change Password Expired Token Error
     * @return string
     */
    public static function CPETE(){
        return Response::makeResponse("CPETE", "The codes has expired");
    }

    /**
     * Already Logged In Error
     * @return string
     */
    public static function ALIE(){
        return Response::makeResponse("ALIE", "You are already logged in");
    }

    /**
     * Not Logged In Error
     * @return string
     */
    public static function NLIE(){
        return Response::makeResponse("NLIE", "You are not logged in");
    }

    /**
     * No Password Error
     * @return string
     */
    public static function NPE(){
        return Response::makeResponse("NPE", "Password is required");
    }

    /**
     * Phone Already Verified Error
     */
    public static function PAVE(){
        return Response::makeResponse("PAVE", "You have already verified this number");
    }

    /**
     * Wrong Code Error
     */
    public static function WCE(){
        return Response::makeResponse("WCE", "You entered an invalid code");
    }

    /**
     * Not a Vendor Error
     */
    public static function NAVE(){
        return Response::makeResponse("NAVE", "You don't have any registered business on ZiQ");
    }
}

?>
      