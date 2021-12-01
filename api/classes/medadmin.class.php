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
  public function __construct(){
    #code here..
  }

}

?>
      