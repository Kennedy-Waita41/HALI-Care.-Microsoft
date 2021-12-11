<?php 
/**
 * VitalSigns
 */

#new-requirements-insert-point


class VitalSigns{
 
#new-traits-insert-point
  
  private $id,
          $bloodPressure,
          $pulseRate,
          $respirationRate,
          $bodyTemperature,
          $createdOn,
          $updatedOn;
  /**
   * VitalSigns
   */
  public function __construct($consultationId = 0){
      if($consultationId < 1){
        return;
      }

      $this->id = $consultationId;
      $this->load($consultationId);
  }

  /**
   * Loads patient vitals from the database
   * @param int $consultationId - the consultation ID
   */
  public function load($consultationId)
  {
    $dbManager = new DbManager();
    $vInfo = $dbManager->query(Consultation::VITALSIGNS_TABLE, ["*"], Consultation::CONSULT_FOREIGN_ID . " = ?", [$consultationId]);

    if($vInfo === false){
      return false;
    }

    $this->setBloodPressure($vInfo["blood_pressure"]);
    $this->setBodyTemperature($vInfo["body_temp"]);
    $this->setRespirationRate($vInfo["respiration_rate"]);
    $this->setPulseRate($vInfo["pulse_rate"]);

    return true;
  }

  /**
   * Updates the vital signs
   * @param DbManager $dbManager - if available
   */
  private function update($dbManager = null){
    if(empty($this->id)){
      exit(Respond::NCFE()); //no consultation found error
    }

    $values = [];
    $updateStr = "";

    if(!empty($this->bloodPressure)){
      $updateStr .= "blood_pressure = ?";
      $values[] = $this->bloodPressure;
    }

    if(!empty($this->respirationRate)){
      $updateStr .= ($updateStr !== "")? ", ": "";
      $updateStr .= "respiration_rate = ?";
      $values[] = $this->respirationRate;
    }

    if(!empty($this->bodyTemperature)){
      $updateStr .= ($updateStr !== "")? ", ": "";
      $updateStr .= "body_temp = ?";
      $values[] = $this->bodyTemperature;
    }

    if(!empty($this->pulseRate)){
      $updateStr .= ($updateStr !== "")? ", ": "";
      $updateStr .= "pulse_rate = ?";
      $values[] = $this->pulseRate;
    }
    if($dbManager == null){
      $dbManager = new DbManager();
    }
    if(!$dbManager->update(Consultation::VITALSIGNS_TABLE, $updateStr, $values,Consultation::CONSULT_FOREIGN_ID ." = ?", [$this->id])){
      return Respond::SQE();
    }

    return Respond::OK();
  }

  /**
   * Adds a new vitals to the vitals table
   * Will remove the old vitals and add the new one
   * @param DbManager $dbManager
   */
  private function add($dbManager = null){
    if(empty($this->id)){
      return Respond::NCFE(); // no consultation found error
    }

    $dbManager = ($dbManager === null) ? new DbManager(): $dbManager;

    if(!$dbManager->insert(Consultation::VITALSIGNS_TABLE, [Consultation::CONSULT_FOREIGN_ID],[$this->id]) === -1){
      return Respond::SQE();
    }

    return $this->update($dbManager);
  }

  /**
   * Adds a new vital signs.
   * This function will delete the old row, and add the new one
   */
  public function save(){
    $dbManager = new DbManager();
    if(!$dbManager->delete(Consultation::VITALSIGNS_TABLE, Consultation::CONSULT_FOREIGN_ID . " = ?", [$this->id])){
      return Respond::SQE();
    }

    return $this->add($dbManager);
  }

  /**
   * Get the value of id
   */ 
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */ 
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of bloodPressure
   */ 
  public function getBloodPressure()
  {
            return $this->bloodPressure;
  }

  /**
   * Set the value of bloodPressure
   *
   * @return  self
   */ 
  public function setBloodPressure($bloodPressure)
  {
            $this->bloodPressure = $bloodPressure;

            return $this;
  }

  /**
   * Get the value of pulseRate
   */ 
  public function getPulseRate()
  {
            return $this->pulseRate;
  }

  /**
   * Set the value of pulseRate
   *
   * @return  self
   */ 
  public function setPulseRate($pulseRate)
  {
            $this->pulseRate = $pulseRate;

            return $this;
  }

  /**
   * Get the value of respirationRate
   */ 
  public function getRespirationRate()
  {
            return $this->respirationRate;
  }

  /**
   * Set the value of respirationRate
   *
   * @return  self
   */ 
  public function setRespirationRate($respirationRate)
  {
            $this->respirationRate = $respirationRate;

            return $this;
  }

  /**
   * Get the value of bodyTemperature
   */ 
  public function getBodyTemperature()
  {
            return $this->bodyTemperature;
  }

  /**
   * Set the value of bodyTemperature
   *
   * @return  self
   */ 
  public function setBodyTemperature($bodyTemperature)
  {
            $this->bodyTemperature = $bodyTemperature;

            return $this;
  }

  /**
   * Get the value of updatedOn
   */ 
  public function getUpdatedOn()
  {
            return $this->updatedOn;
  }

  /**
   * Set the value of updatedOn
   *
   * @return  self
   */ 
  public function setUpdatedOn($updatedOn)
  {
            $this->updatedOn = $updatedOn;

            return $this;
  }

  /**
   * Get the value of createdOn
   */ 
  public function getCreatedOn()
  {
            return $this->createdOn;
  }

  /**
   * Set the value of createdOn
   *
   * @return  self
   */ 
  public function setCreatedOn($createdOn)
  {
            $this->createdOn = $createdOn;

            return $this;
  }
}

?>
      