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

  /**
   * MedAssistant
   */
  public function __construct(){
    #code here..
  }

}

?>
      