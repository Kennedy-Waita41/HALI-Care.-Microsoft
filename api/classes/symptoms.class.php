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
    $symInfo = $dbManager->query(Consultation::SYMPTOMS_TABLE, ["*"], Consultation::CONSULT_FOREIGN_ID . " = ?", [$consultationId]);

    if($symInfo === false){
      return false;
    }

    $this->setSymptoms($symInfo["symptoms"]);
    $this->setDateAdded($symInfo["created_on"]);

    return true;
  }

  /**
   * Adds a new symptoms to the symptoms table
   * Will remove the old symptoms and add the new one
   * @param DbManager $dbManager
   */
  private function add($dbManager = null){
    if(empty($this->id)){
      return Respond::NCFE(); // no consultation found error
    }

    $dbManager = ($dbManager === null) ? new DbManager(): $dbManager;

    if(!$dbManager->insert(Consultation::SYMPTOMS_TABLE, [Consultation::CONSULT_FOREIGN_ID],[$this->id]) === -1){
      return Respond::SQE();
    }

    return $this->update($dbManager);
  }


  /**
   * Adds a new symptoms
   * This function will delete the old row, and add the new one
   */
  public function save(){
    $dbManager = new DbManager();
    if(!$dbManager->delete(Consultation::SYMPTOMS_TABLE, Consultation::CONSULT_FOREIGN_ID . " = ?", [$this->id])){
      return Respond::SQE();
    }

    return $this->add($dbManager);
  }

    /**
   * Updates the symptoms
   * @param DbManager $dbManager - if available
   */
  private function update($dbManager = null){
    if(empty($this->id)){
      exit(Respond::NCFE()); //no consultation found error
    }

    $values = [];
    $updateStr = "";

    if(!empty($this->symptoms)){
      $updateStr .= "symptoms = ?";
      $values[] = $this->symptoms;
    }

    if($dbManager == null){
      $dbManager = new DbManager();
    }
    if(!$dbManager->update(Consultation::SYMPTOMS_TABLE, $updateStr, $values,Consultation::CONSULT_FOREIGN_ID ." = ?", [$this->id])){
      return Respond::SQE();
    }

    return Respond::OK();
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
      