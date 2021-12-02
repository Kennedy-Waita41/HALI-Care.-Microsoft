<?php 
/**
 * Doctor
 */

require_once(__DIR__.'/../interfaces/doctorconstants.interface.php');
require_once(__DIR__.'/../interfaces/doctordefaults.interface.php');
require_once(__DIR__.'/../interfaces/doctortable.interface.php');
#new-requirements-insert-point


class Doctor extends User implements  DoctorConstantsInterface ,  DoctorDefaultsInterface ,  DoctorTableInterface {
 
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
      $doctorInfo = $dbManager->query(Doctor::DOC_TABLE, ["*"], User::USER_FOREIGN_ID. " = ?", [$this->id]);
      if($doctorInfo === false) return false;
      $this->setId($doctorInfo[User::USER_FOREIGN_ID]);
      return parent::loadUser($this->id);
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
      