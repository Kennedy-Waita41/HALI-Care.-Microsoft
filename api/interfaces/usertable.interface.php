<?php 
/**
 * UserTableInterface
 */ 


interface UserTableInterface{
    const   USER_TABLE = "user",
            USER_ID = "`user`.`id`",
            SESSION_TABLE = "session",
            S_TOKEN = "session_token",
            SESSION_ID = "session_id";

}

?>
      