<?php 
/**
 * ConsultationTableInterface
 */ 


interface ConsultationTableInterface{
    const CONSULT_TABLE = "consultation",
          CONSULT_ID = "`consultation`.`id`",
          CONSULT_FOREIGN_ID = "consultationId",
          SYMPTOMS_TABLE = "symptoms",
          VITALSIGNS_TABLE = "vital_signs",
          DOCTOR_CONSULT_TABLE = "doctor_consultation";
}

?>
      