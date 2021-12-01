<?php 
/**
 * Patient
 */

require_once(__DIR__.'/../interfaces/patientconstants.interface.php');
require_once(__DIR__.'/../interfaces/patientdefaults.interface.php');
require_once(__DIR__.'/../interfaces/patienttable.interface.php');
#new-requirements-insert-point


class Patient extends User implements  PatientConstantsInterface ,  PatientDefaultsInterface ,  PatientTableInterface {
 
#new-traits-insert-point

  /**
   * Patient
   */
  public function __construct(){
    #code here..
  }

}

?>
      