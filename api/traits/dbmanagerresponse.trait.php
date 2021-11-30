<?php 
/** 
* DbManagerResponseTrait
*/ 


trait DbManagerResponseTrait{

    
    /**
     * SQL Error
     * @return string
     */
    public static function SQE(){
        return Response::makeResponse("SQE", "An error occurred while connecting to the storage system");
    }

}

?>
      