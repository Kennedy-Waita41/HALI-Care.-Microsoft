<?php 
/**
 * ApprovableTrait: If the user needs to be approved
 */ 


trait ApprovableTrait{

  /**
   * checks if the medical practitioner should be approved.
   * The user must have their firstname, lastname, email, phone, and hospital inorder
   * to be eligible for approval.
   */
  public function isApprovable(){
    if(empty($this->firstName)  ||
       empty($this->lastName)   ||
       empty($this->email)      || 
       empty($this->hospital)   ||
       empty($this->phone) )
       return false;
    return true;
  }

  

}

?>
      