<?php 
/**
 * Consultation
 */

require_once(__DIR__.'/../interfaces/consultationconstants.interface.php');
require_once(__DIR__.'/../interfaces/consultationdefaults.interface.php');
require_once(__DIR__.'/../interfaces/consultationtable.interface.php');
#new-requirements-insert-point


class Consultation implements  ConsultationConstantsInterface ,  ConsultationDefaultsInterface ,  ConsultationTableInterface {
 
#new-traits-insert-point

  /**
   * Consultation
   */
  private $consultationId,
          $patientId,
          $consultationStatus,
          $dateAdded,
          $symptoms,
          $vitalSigns;

  public function __construct($consultationId = 0){
    if($consultationId < 1) return;
    $this -> load($consultationId);
  }

  /**
   * Loads all consultation information
   */
  public function load($consultationId){
    $this -> setConsultationId($consultationId);
    $dbManager = new DbManager();
    $consultationInfo = $dbManager->query(Consultation::CONSULT_TABLE, ["*"], Consultation::CONSULT_ID. " = ?", [$this->consultationId]);
    if($consultationInfo === false) return false;

    $this->setConsultationStatus($consultationInfo["consult_status"]);
    $this->setPatientId($consultationInfo[Patient::PATIENT_FOREIGN_ID]);
    $this->setSymptoms(new Symptoms($this->consultationId));
    $this->setVitalSigns(new VitalSigns($this->consultationId));    
  }

  /**
   * Called to mark consultation as completed: Called by doctor or medical assistant after consultation
   */
  public function complete(){
    return(new DbManager()) -> update(Consultation::CONSULT_TABLE, "consult_status = ?", [Consultation::CONSULT_COMPLETE], Consultation::CONSULT_ID." = ?", [$this->consultationId]);
  }

  /**
   * Called to generate consultation ticket
   */
  public static function getTicket($consultationId){
    return Consultation::CON." - ".$consultationId;
  }

  /**
   * Get consultation id
   */ 
  public function getConsultationId()
  {
    return $this->consultationId;
  }

  /**
   * Set consultation id
   *
   * @return  self
   */ 
  public function setConsultationId($consultationId)
  {
    $this->consultationId = $consultationId;

    return $this;
  }

  /**
   * Get consultation ID from ticket
   * @param string $consultationTicket
   */
  public static function getIdFromTicket($consultationTicket){
    return preg_split("/-/", $consultationTicket)[1];
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
   * Get the value of consultationStatus
   */ 
  public function getConsultationStatus()
  {
    return $this->consultationStatus;
  }

  /**
   * Set the value of consultationStatus
   * 
   * @return  self
   */ 
  public function setConsultationStatus($consultationStatus)
  {
    $this->consultationStatus = $consultationStatus;

    return $this;
  }

  /**
   * Get the value of dateAdded
   */ 
  public function getDateAdded()
  {
    return $this->dateAdded;
  }

  /**
   * Set the value of dateAdded
   *
   * @return  self
   */ 
  public function setDateAdded($dateAdded)
  {
    $this->dateAdded = $dateAdded;

    return $this;
  }

  /**
   * Get the value of symptoms
   * @return Symptoms
   */ 
  public function getSymptoms()
  {
            return $this->symptoms;
  }

  /**
   * Set the value of symptoms
   *
   * @return  self
   */ 
  public function setSymptoms(Symptoms $symptoms)
  {
            $this->symptoms = $symptoms;

            return $this;
  }

  /**
   * Get the value of vitalSigns
   * @return VitalSigns
   */ 
  public function getVitalSigns()
  {
            return $this->vitalSigns;
  }

  /**
   * Set the value of vitalSigns
   *
   * @return  self
   */ 
  public function setVitalSigns(vitalSigns $vitalSigns)
  {
            $this->vitalSigns = $vitalSigns;

            return $this;
  }
}

?>