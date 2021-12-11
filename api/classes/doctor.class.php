<?php 
/**
 * Doctor
 */

require_once(__DIR__.'/../interfaces/doctorconstants.interface.php');
require_once(__DIR__.'/../interfaces/doctordefaults.interface.php');
require_once(__DIR__.'/../interfaces/doctortable.interface.php');
require_once(__DIR__.'/../traits/approvable.trait.php');
#new-requirements-insert-point


class Doctor extends User implements  DoctorConstantsInterface ,  DoctorDefaultsInterface ,  DoctorTableInterface {
 
use ApprovableTrait;
#new-traits-insert-point

  /**
   * Doctor
   */
  private $doctorId,
          $hospital,
          $accountStatus;

  /**
   * @param int $doctorId - The doctor ID from the doctor table. Usually,
   * this will be in the user name.
   * doctor
   */
  public function __construct($doctorId = 0){
    if($doctorId < 1) return;

    $this->load($doctorId);
  }

  /**
   * loads all the doctor information
   */
  public function load($doctorId){
      $this->setDoctorId($doctorId);

      $dbManager = new DbManager();
      $doctorInfo = $dbManager->query(Doctor::DOC_TABLE, ["*"], Doctor::DOC_ID. " = ?", [$this->id]);
      if($doctorInfo === false) return false;
      $this->setId($doctorInfo[User::USER_FOREIGN_ID]);
      return parent::loadUser($this->id);
  }

  /**
   * requires the patient username and password
   */
  public function login(){
    if(!isset($this->username)){
      return Respond::NUE();
    }
    $this->setDoctorId(User::getIdFromUserName($this->username));
    $this->setId($this->getUserId($this->doctorId, Doctor::DOC_ID, Doctor::DOC_TABLE));
    return parent::login();
  }

  /**
   * requirements: firstname, lastname, hospital and password
   */
  public function register(){
    if(empty($this->firstName)) return Respond::NFNE();
    if(empty($this->lastName)) return Respond::NLNE();
    if(empty($this->hospital)) return Respond::NHE();

    if(!Utility::checkName($this->firstName) || !Utility::checkName($this->lastName)) return Respond::UNE();

    if(!Utility::checkName($this->hospital)) return Respond::UQHNE();

    $response = parent::register();
    if($response != Respond::OK()) return $response;

    $dbManager = new DbManager();
    $doctorId = $dbManager->insert(Doctor::DOC_TABLE, [User::USER_FOREIGN_ID, "hospital"],[$this->id, $this->hospital]);

    if($doctorId == -1) return Respond::SQE();
    $this->setDoctorId($doctorId);

    $message = [
      "username" => Doctor::genUserName($this->doctorId),
      "hospital" => $this->hospital,
      "firstName" => $this->firstName,
      "lastName" => $this->lastName,
      "message" => "Successfully registered Doctor"
    ];

    return Respond::makeResponse(
      "OK",
      json_encode($message)
    );
  }

  /**
   * @param int $doctorId - Doctor ID
   */
  public static function genUserName($doctorId){
    return User::generateUserName($doctorId, Doctor::DOC);
  }

  /**
   * called to approve a doctor. It should only be called by the Admins
   */
  public function approve(){
    return (new DbManager())->update(Doctor::DOC_TABLE, "account_status = ?", [Doctor::ACCOUNT_APPROVED], Doctor::DOC_ID." = ?", [$this->doctorId]);
  }

  /**
   * change the account status to pending.
   */
  public function pend(){
    return (new DbManager())->update(Doctor::DOC_TABLE, "account_status = ?", [Doctor::ACCOUNT_PENDING], Doctor::DOC_ID." = ?", [$this->doctorId]);
  }

  /**
   * change the account status to declined.
   */
  public function decline(){
    return (new DbManager())->update(Doctor::DOC_TABLE, "account_status = ?", [Doctor::ACCOUNT_DECLINED], Doctor::DOC_ID." = ?", [$this->doctorId]);
  }

  /**
   * Assign this doctor to a consultation
   * 
   */
  public function assignToConsultation(Consultation $consultation, $medId = 0){
    if(!$this->isApprovable()){
      return Respond::NDCIE();
    }

    if(!$consultation->assign($this->id, $medId)){
      return Respond::SQE();
    }

    return Respond::OK();
  }

  /**
   * Get the value of doctorId
   */ 
  public function getdoctorId()
  {
    return $this->doctorId;
  }

  /**
   * Set the value of doctorId
   *
   * @return  self
   */ 
  public function setDoctorId($doctorId)
  {
    $this->doctorId = $doctorId;

    return $this;
  }
  
  /**
   * Get the value of hospital
   */ 
  public function getHospital()
  {
            return $this->hospital;
  }

  /**
   * Set the value of hospital
   *
   * @return  self
   */ 
  public function setHospital($hospital)
  {
            $this->hospital = $hospital;

            return $this;
  }

  /**
   * Get the value of accountStatus
   */ 
  public function getAccountStatus()
  {
            return $this->accountStatus;
  }

  /**
   * Set the value of accountStatus
   *
   * @return  self
   */ 
  public function setAccountStatus($accountStatus)
  {
            $this->accountStatus = $accountStatus;

            return $this;
  }
}

?>
      