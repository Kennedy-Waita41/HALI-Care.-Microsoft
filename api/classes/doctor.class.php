<?php 
/**
 * Doctor
 */

require_once(__DIR__.'/../interfaces/doctorconstants.interface.php');
require_once(__DIR__.'/../interfaces/doctordefaults.interface.php');
require_once(__DIR__.'/../interfaces/doctortable.interface.php');
#new-requirements-insert-point


class Doctor extends User implements  DoctorConstantsInterface ,  DoctorDefaultsInterface ,  DoctorTableInterface {
 
#new-traits-insert-point

  /**
   * Doctor
   */
  public function __construct(){
    #code here..
  }

}

?>
      