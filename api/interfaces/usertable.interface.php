<?php 
/**
 * UserTableInterface
 */ 


interface UserTableInterface{
    const   USER_TABLE = "user",
            USER_ID = "`user`.`id`",
            USER_FOREIGN_ID = "userId",
            TMP_PHONE_TABLE = "temporary_phone_number",
            TMP_EMAIL_TABLE = "temporary_email",
            SESSION_TABLE = "session",
            S_TOKEN = "session_token",
            SESSION_ID = "session_id";

}

?>
      