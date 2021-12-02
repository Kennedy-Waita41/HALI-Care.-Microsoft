<?php 
/**
 * SystemAdmin
 */

require_once(__DIR__.'/../interfaces/systemadminconstants.interface.php');
require_once(__DIR__.'/../interfaces/systemadmindefaults.interface.php');
require_once(__DIR__.'/../interfaces/systemadmintable.interface.php');
#new-requirements-insert-point


class SystemAdmin extends User implements  SystemAdminConstantsInterface ,  SystemAdminDefaultsInterface ,  SystemAdminTableInterface {
 
#new-traits-insert-point

  /**
   * SystemAdmin
   */
  public function __construct(){
    
  }

  /**
   * Approves a Doctor, MedAssistant or Doctor
   * @param MedAdmin|MedAssistant|Doctor $user
   */
  public function approve($user){
    if(!$user->isApprovable()) return false;
    return $user->approve();
  }
}

?>
      