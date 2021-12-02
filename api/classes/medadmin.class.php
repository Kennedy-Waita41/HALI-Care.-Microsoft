<?php 
/**
 * MedAdmin
 */

require_once(__DIR__.'/../interfaces/medadminconstants.interface.php');
require_once(__DIR__.'/../interfaces/medadmindefaults.interface.php');
require_once(__DIR__.'/../interfaces/medadmintable.interface.php');
#new-requirements-insert-point


class MedAdmin extends User implements  MedAdminConstantsInterface ,  MedAdminDefaultsInterface ,  MedAdminTableInterface {
 
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
      $medAdminInfo = $dbManager->query(MedAdmin::MED_ADMIN_TABLE, ["*"], User::USER_FOREIGN_ID. " = ?", [$this->id]);
      if($medAdminInfo === false) return false;
      $this->setId($medAdminInfo[User::USER_FOREIGN_ID]);
      return parent::loadUser($this->id);
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
      