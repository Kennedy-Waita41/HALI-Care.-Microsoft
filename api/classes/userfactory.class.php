<?php 
/**
 * UserFactory
 */
 


class UserFactory{
 

  /**
   * UserFactory
   */
  private function __construct(){
    //code here..
  }

  /**
   * Returns a user object which is either a patient, doctor, medassistant, med admin or system Admin.
   * Please ensure that the username is in the correct format
   * @return Patient|Doctor|MedAssistant|MedAdmin|SystemAdmin
   */
  public static function makeUser($username){
    $info = preg_split("/-/", $username);
    $id = User::getIdFromUserName($username);

    switch($info[0]){
      case Patient::PAT: return new Patient($id);
      case Doctor::DOC: return new Doctor($id);
      case MedAssistant::MA: return new MedAssistant($id);
      case MedAdmin::MDA: return new MedAdmin($id);
      case SystemAdmin::SA: return new SystemAdmin($id);
    }
  }
}

?>
      