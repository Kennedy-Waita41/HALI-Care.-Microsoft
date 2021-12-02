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

  private $patientId,
          $dob;

  /**
   * @param int $patientId - The Patient ID from the patient table. Usually,
   * this will be in the user name.
   * Patient
   */
  public function __construct($patientId = 0){
    if($patientId < 1) return;

    $this->load($patientId);
  }

  /**
   * loads all the patient information
   */
  public function load($patientId){
      $this->setPatientId($patientId);

      $dbManager = new DbManager();
      $patientInfo = $dbManager->query(Patient::PATIENT_TABLE, ["*"], Patient::PATIENT_ID. " = ?", [$this->patientId]);
      if($patientInfo === false) return false;
      $this->setId($patientInfo[User::USER_FOREIGN_ID]);
      return parent::loadUser($this->id);
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
   * requirements: firstname, lastname and password
   */
  public function register(){
    if(empty($this->firstName)) return Respond::NFNE();
    if(empty($this->lastName)) return Respond::NLNE();

    if(!Utility::checkName($this->firstName) || !Utility::checkName($this->lastName)) return Respond::UNE();

    $response = parent::register();
    if($response != Respond::OK()) return $response;

    $dbManager = new DbManager();
    $patientId = $dbManager->insert(Patient::PATIENT_TABLE, [User::USER_FOREIGN_ID],[$this->id]);

    if($patientId == -1) return Respond::SQE();
    $this->setPatientId($patientId);

    $message = [
      "username" => Patient::genUserName($this->patientId),
      "firstName" => $this->firstName,
      "lastName" => $this->lastName,
      "message" => "Successfully registered patient"
    ];
    return Respond::makeResponse(
      "OK",
      json_encode($message)
    );
  }

  /**
   * @param int $id - patient ID
   */
  public static function genUserName($patientId){
    return User::generateUserName($patientId, Patient::PAT);
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

  /**
   * Get the value of dob
   */ 
  public function getDob()
  {
            return $this->dob;
  }

  /**
   * Set the value of dob
   *
   * @return  self
   */ 
  public function setDob($dob)
  {
            $this->dob = $dob;

            return $this;
  }
}

?>
      