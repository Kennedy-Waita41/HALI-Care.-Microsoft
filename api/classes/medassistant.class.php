<?php 
/**
 * MedAssistant
 */

require_once(__DIR__.'/../interfaces/medassistantconstants.interface.php');
require_once(__DIR__.'/../interfaces/medassistantdefaults.interface.php');
require_once(__DIR__.'/../interfaces/medassistanttable.interface.php');
require_once(__DIR__.'/../traits/approvable.trait.php');
#new-requirements-insert-point


class MedAssistant extends User implements  MedAssistantConstantsInterface ,  MedAssistantDefaultsInterface ,  MedAssistantTableInterface {
 
 use ApprovableTrait;
#new-traits-insert-point

  private $mAId,
          $hospital,
          $accountStatus;
          
  /**
   * MedAssistant
   */
  public function __construct($mAId = 0){
    if($mAId < 1) return;
    $this->load($mAId);
  }


  public function load($mAId){
      $this->setMAId($mAId);

      $dbManager = new DbManager();
      $mAInfo = $dbManager->query(MedAssistant::MA_TABLE, ["*"], MedAssistant::MA_ID. " = ?", [$this->mAId]);
      if($mAInfo === false) return false;
      $this->setId($mAInfo[User::USER_FOREIGN_ID]);
      $this->setHospital($mAInfo["hospital"]);
      
      return parent::loadUser($this->id);
  }

  /**
   * requires the patient username and password
   */
  public function login(){
    if(!isset($this->username)){
      return Respond::NUE();
    }
    $this->setMAId(User::getIdFromUserName($this->username));
    $this->setId($this->getUserId($this->mAId, MedAssistant::MA_ID, MedAssistant::MA_TABLE));
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
    $mAId = $dbManager->insert(MedAssistant::MA_TABLE, [User::USER_FOREIGN_ID, "hospital"],[$this->id, $this->hospital]);

    if($mAId == -1) return Respond::SQE();
    $this->setMAId($mAId);

    $message = [
      "username" => MedAssistant::genUserName($this->mAId),
      "hospital" => $this->hospital,
      "firstName" => $this->firstName,
      "lastName" => $this->lastName,
      "message" => "Successfully registered Medical Assistant"
    ];

    return Respond::makeResponse(
      "OK",
      json_encode($message)
    );
  }

  /**
   * @param int $mAId - Medical Assistant ID
   */
  public static function genUserName($mAId){
    return User::generateUserName($mAId, MedAssistant::MA);
  }

  /**
   * Approves a medical assistant account (change status to )
   */
  public function approve(){
    return (new DbManager())->update(MedAssistant::MA_TABLE, "account_status = ?", [MedAssistant::ACCOUNT_APPROVED], MedAssistant::MA_ID." = ?", [$this->mAId]);
  }

  /**
   * change the account status to pending
   */
  public function pend(){
    return (new DbManager())->update(MedAssistant::MA_TABLE, "account_status = ?", [MedAssistant::ACCOUNT_PENDING], MedAssistant::MA_ID." = ?", [$this->mAId]);
  }

  /**
   * change the account status to pending
   */
  public function decline(){
    return (new DbManager())->update(MedAssistant::MA_TABLE, "account_status = ?", [MedAssistant::ACCOUNT_DECLINED], MedAssistant::MA_ID." = ?", [$this->mAId]);
  }

  /**
   * Assigns a doctor to a consultation
   * @param Consultation $consultation
   * @param int $doctorId
   */
  public function assignDoctor($consultation, $doctorId){
    if(empty($this->id)){
      return Respond::NIE();
    }

    $doctor = new Doctor($doctorId);

    $resp = $doctor->assignToConsultation($consultation, $this->mAId);

    if($resp == Respond::NDCIE()){
      return Respond::DCINSE();
    }

    return $resp;
  }

  /**
   * Get the value of mAId
   */ 
  public function getMAId()
  {
    return $this->mAId;
  }

  /**
   * Set the value of mAId
   *
   * @return  self
   */ 
  public function setMAId($mAId)
  {
    $this->mAId = $mAId;

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
      