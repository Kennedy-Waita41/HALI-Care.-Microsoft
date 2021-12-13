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
          $vitalSigns,
          $doctorId,
          $medAssistantId,
          $isAssigned = false,
          $dateAssigned;

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
    
    //loading doctor and medical assistants if they are set.
    $assignedInfo = $dbManager->query(Consultation::DOCTOR_CONSULT_TABLE, ["*"], Consultation::CONSULT_FOREIGN_ID . " = ?", [$this->consultationId]);

    if($assignedInfo !== false){
      $this->setDoctorId($assignedInfo[Doctor::DOC_FOREIGN_ID]);
      $this->setMedAssistantId($assignedInfo[MedAssistant::MA_FOREIGN_ID]);
      $this->setDateAssigned($assignedInfo["created_on"]);
      $this->setAsAssigned(true);
    } 

    return true;
  }

  /**
   * Called to mark consultation as completed: Called by doctor or medical assistant after consultation
   */
  public function complete(){
    return(new DbManager()) -> update(Consultation::CONSULT_TABLE, "consult_status = ?", [Consultation::CONSULT_COMPLETE], Consultation::CONSULT_ID." = ?", [$this->consultationId]);
  }

  public function add(){
    if(!isset($this->patientId)){
      return Respond::NPIFE();
    }

    $dbManager = new DbManager();
    $insertId = $dbManager->insert(Consultation::CONSULT_TABLE, [Patient::PATIENT_FOREIGN_ID], [$this->patientId]);

    if($insertId === -1){
      return Respond::SQE();
    }

    $this->consultationId = $insertId;
    $ticket = Consultation::getTicket($this->consultationId);

    return Respond::makeResponse(Respond::STATUS_OK, 
    json_encode([
      "ticket" => $ticket,
      "message" => Respond::MSG_SUCCESS]));
  }

  /**
   * Assigns a consultation to a doctor and a medical.
   */
  public function assign($docId, $medId = 0){
    $columns = [Consultation::CONSULT_FOREIGN_ID];
    $values = [$this->consultationId];
    $columns[] = Doctor::DOC_FOREIGN_ID;
    $values[] = $docId;
    

    if($medId > 0){
      $columns[] = MedAssistant::MA_FOREIGN_ID;
      $values[] = $medId;
    }

    $dbManager = new DbManager();
    
    if(!$dbManager->delete(Consultation::DOCTOR_CONSULT_TABLE, Consultation::CONSULT_FOREIGN_ID . " = ?", [$this->consultationId])){
      
      return false;
    }
    
    if($dbManager->insert(Consultation::DOCTOR_CONSULT_TABLE, $columns, $values) < 0){
      return false;
    }

    return true;
  }

  /**
   * Updates the status of a consultation in the database
   * 
   */
  public function changeStatus($status = Consultation::CONSULT_PENDING, DbManager $dbManager = null){
    if($dbManager == null){
      $dbManager = new DbManager();
    }

    return $dbManager->update(Consultation::CONSULT_TABLE, "consult_status = ?", [$status], Consultation::CONSULT_ID . " = ?", [$this->consultationId]);
  }

  /**
   * checks if the consultation can be assigned by checking if it has
   *  recorded symptoms
   */
  public function isAssignable(){
    return (empty($this->symptoms)) ? false: true;
  }
  /**
   * Called to generate consultation ticket
   */
  public static function getTicket($consultationId){
    return Consultation::CON."-".$consultationId;
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

  /**
   * Get the value of doctorId
   */ 
  public function getDoctorId()
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
   * Get the value of medAssistantId
   */ 
  public function getMedAssistantId()
  {
            return $this->medAssistantId;
  }

  /**
   * Set the value of medAssistantId
   *
   * @return  self
   */ 
  public function setMedAssistantId($medAssistantId)
  {
            $this->medAssistantId = $medAssistantId;

            return $this;
  }

  /**
   * Get the value of isAssigned
   */ 
  public function isAssigned()
  {
            return $this->isAssigned;
  }

  /**
   * Set the value of isAssigned
   *
   * @return  self
   */ 
  public function setAsAssigned($isAssigned)
  {
            $this->isAssigned = $isAssigned;

            return $this;
  }

  /**
   * Get the value of dateAssigned
   */ 
  public function getDateAssigned()
  {
            return $this->dateAssigned;
  }

  /**
   * Set the value of dateAssigned
   *
   * @return  self
   */ 
  public function setDateAssigned($dateAssigned)
  {
            $this->dateAssigned = $dateAssigned;

            return $this;
  }
}

?>