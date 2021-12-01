<?php 
/**
 * Patient
 */

require_once(__DIR__.'/../interfaces/patientconstants.interface.php');
require_once(__DIR__.'/../interfaces/patientdefaults.interface.php');
require_once(__DIR__.'/../interfaces/patienttable.interface.php');
#new-requirements-insert-point


class Patient extends User implements  PatientConstantsInterface ,  PatientDefaultsInterface ,  PatientTableInterface {
 
#new-traits-insert-point

  private $patientId;

  /**
   * Patient
   */
  public function __construct(){
    #code here..
  }

  /**
   * requires the patient username and password
   */
  public function login(){
    if(!isset($this->username)){
      return Respond::NUE();
    }
    $this->setPatientId(User::getIdFromUserName($this->username));
    $this->setId($this->getUserId($this->patientId, Patient::PATIENT_ID, Patient::PATIENT_TABLE));
    return parent::login();
  }

  /**
   * requirements: firstname, lastname, phone, and password
   */
  public function register(){

  }

  /**
   * @param int $id - patient ID
   */
  public static function genUserName($id){
    return User::generateUserName($id, Patient::PAT);
  }

  /**
   * Get the value of patientId
   */ 
  public function getPatientId()
  {
    return $this->patientId;
  }

  /**
   * Set the value of patientId
   *
   * @return  self
   */ 
  public function setPatientId($patientId)
  {
    $this->patientId = $patientId;

    return $this;
  }
}

?>
      