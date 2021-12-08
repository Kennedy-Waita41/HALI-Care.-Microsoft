<?php 
/** 
* Respond
*/

require_once(__DIR__.'/../traits/userresponse.trait.php');
require_once(__DIR__.'/../traits/generalresponse.trait.php');
require_once(__DIR__.'/../traits/dbmanagerresponse.trait.php');

require_once(__DIR__.'/../traits/patientresponse.trait.php');
require_once(__DIR__.'/../traits/doctorresponse.trait.php');
require_once(__DIR__.'/../traits/medadminresponse.trait.php');
require_once(__DIR__.'/../traits/systemadminresponse.trait.php');
require_once(__DIR__.'/../traits/medassistantresponse.trait.php');
require_once(__DIR__.'/../traits/consultationresponse.trait.php');
#new-requirements-insert-point

class Respond{
use UserResponseTrait;
use DbManagerResponseTrait;
use GeneralResponseTrait;
use PatientResponseTrait;
use DoctorResponseTrait;
use MedAdminResponseTrait;
use SystemAdminResponseTrait;
use MedAssistantResponseTrait;
use ConsultationResponseTrait;
#new-traits-insert-point

    private $message, $status, $format;

    const F_HTML = "html", F_PLAIN = "plain";

    public function __construct()
    {
        
    }

    /**
     * Make a new response
     * @param string $status - Status code
     * @param string $message - The message to send
     * @return string
     */
    public static function makeResponse($status, $message){
        return Response::makeResponse($status, $message);
    }

    /**
     * builds a Respond by setting the status and empty message;
     * @param $format - Format of the message. 
     * If `Respond::F_HTML`, then <br> will be inserted after messages.
     * If `Respond::F_PLAIN`, then spaces will be added between messages. 
     */
    public function build($status, $format = Respond::F_PLAIN){
        $this->status = $status;
        $this->message = "";
        $this->format = $format;
    }

    public function addMessage($messageChunk){
        $joinedBy = ($this->format == Respond::F_HTML)? "<br>" : " ";
        $this->message .= $messageChunk.$joinedBy;
    }

 
    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Returns the JSON built message
     */
    public function getBuiltJson(){
        return Response::makeResponse($this->status, $this->message);
    }
}

?>
      