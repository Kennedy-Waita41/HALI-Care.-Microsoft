<?php 
/**
 * MedAdmin
 */

require_once(__DIR__.'/../interfaces/medadminconstants.interface.php');
require_once(__DIR__.'/../interfaces/medadmindefaults.interface.php');
require_once(__DIR__.'/../interfaces/medadmintable.interface.php');
require_once(__DIR__.'/../traits/approvable.trait.php');
#new-requirements-insert-point


class MedAdmin extends User implements  MedAdminConstantsInterface ,  MedAdminDefaultsInterface ,  MedAdminTableInterface {
 
use ApprovableTrait;
#new-traits-insert-point

  /**
   * MedAdmin
   */
  private $medAdminId,
          $hospital,
          $accountStatus;

  /**
   * @param int $medAdminId - The MedAdmin ID from the medical admin table. Usually,
   * this will be in the user name.
   * medical admin
   */
  public function __construct($medAdminId = 0){
    if($medAdminId < 1) return;

    $this->load($medAdminId);
  }

  /**
   * loads all the medical admin's information
   */
  public function load($medAdminId){
      $this->setMedAdminId($medAdminId);

      $dbManager = new DbManager();
      $medAdminInfo = $dbManager->query(MedAdmin::MED_ADMIN_TABLE, ["*"], MedAdmin::MED_ADMIN_ID. " = ?", [$this->medAdminId]);
      if($medAdminInfo === false) return false;
      $this->setId($medAdminInfo[User::USER_FOREIGN_ID]);
      return parent::loadUser($this->id);
  }

  /**
   * requires the patient username and password
   */
  public function login(){
    if(!isset($this->username)){
      return Respond::NUE();
    }
    $this->setMedAdminId(User::getIdFromUserName($this->username));
    $this->setId($this->getUserId($this->medAdminId, MedAdmin::MED_ADMIN_ID, MedAdmin::MED_ADMIN_TABLE));
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
    $medAdminId = $dbManager->insert(MedAdmin::MED_ADMIN_TABLE, [User::USER_FOREIGN_ID, "hospital"],[$this->id, $this->hospital]);

    if($medAdminId == -1) return Respond::SQE();
    $this->setMedAdminId($medAdminId);

    $message = [
      "username" => MedAdmin::genUserName($this->medAdminId),
      "hospital" => $this->hospital,
      "firstName" => $this->firstName,
      "lastName" => $this->lastName,
      "message" => "Successfully registered Medical Administrator"
    ];

    return Respond::makeResponse(
      "OK",
      json_encode($message)
    );
  }

  /**
   * @param int $medAdminId - Medical Administrator ID
   */
  public static function genUserName($medAdminId){
    return User::generateUserName($medAdminId, MedAdmin::MDA);
  }

  /**
   * called to approve a doctor. It should only be called by the Admins
   */
  public function approve(){
    return (new DbManager())->update(MedAdmin::MED_ADMIN_TABLE, "account_status = ?", [MedAdmin::ACCOUNT_APPROVED], MedAdmin::MED_ADMIN_ID." = ?", [$this->medAdminId]);
  }

  /**
   * changes the account status to pending
   */
  public function pend(){
    return (new DbManager())->update(MedAdmin::MED_ADMIN_TABLE, "account_status = ?", [MedAdmin::ACCOUNT_PENDING], MedAdmin::MED_ADMIN_ID." = ?", [$this->medAdminId]);
  }

  /**
   * changes the account status to declined
   */
  public function decline(){
    return (new DbManager())->update(MedAdmin::MED_ADMIN_TABLE, "account_status = ?", [MedAdmin::ACCOUNT_DECLINED], MedAdmin::MED_ADMIN_ID." = ?", [$this->medAdminId]);
  }

  /**
   * Get the value of medAdminId
   */ 
  public function getMedAdminId()
  {
    return $this->medAdminId;
  }

  /**
   * Set the value of medAdminId
   *
   * @return  self
   */ 
  public function setMedAdminId($medAdminId)
  {
    $this->medAdminId = $medAdminId;

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
      