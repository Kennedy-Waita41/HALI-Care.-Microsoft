<?php 
/**
 * MedAssistant
 */

require_once(__DIR__.'/../interfaces/medassistantconstants.interface.php');
require_once(__DIR__.'/../interfaces/medassistantdefaults.interface.php');
require_once(__DIR__.'/../interfaces/medassistanttable.interface.php');
#new-requirements-insert-point


class MedAssistant extends User implements  MedAssistantConstantsInterface ,  MedAssistantDefaultsInterface ,  MedAssistantTableInterface {
 
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
      $patientInfo = $dbManager->query(MedAssistant::MA_TABLE, ["*"], User::USER_FOREIGN_ID. " = ?", [$this->id]);
      if($patientInfo === false) return false;
      $this->setId($patientInfo[User::USER_FOREIGN_ID]);
      return parent::loadUser($this->id);
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
      