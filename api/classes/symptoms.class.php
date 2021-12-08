<?php 
/**
 * Symptoms
 */

#new-requirements-insert-point


class Symptoms{
 
#new-traits-insert-point

  private $id,
          $symptoms,
          $dateAdded;

  /**
   * Symptoms
   */
  public function __construct($consultationId = 0){
    if($consultationId < 1){
      return;
    }

    $this->id = $consultationId;
    $this->load($consultationId);
  }

  /**
   * loads the symptoms data from the database
   * @param int $consultationId - the consultation ID 
   */
  public function load($consultationId){
    $dbManager = new DbManager();
    $symInfo = $dbManager->query(Consultation::SYMPTOMS_TABLE, ["*"], Consultation::FOREIGN_ID . " = ?", [$consultationId]);

    if($symInfo === false){
      return false;
    }

    $this->setSymptoms($symInfo["symptoms"]);
    $this->setDateAdded($symInfo["created_on"]);

    return true;
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
   * Get the value of symptoms
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
  public function setSymptoms($symptoms)
  {
            $this->symptoms = $symptoms;

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
}

?>
      