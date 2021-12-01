<?php

    trait UserTrait{

        /**
         * Checks if an email exist already
         * @param string $email
         * @param DatabaseInterface $dbManager
         * @return bool
         */
        public static function doesEmailExist($email, DatabaseInterface $dbManager){
            return UserTrait::doesExist($email, "email", $dbManager);
        }

        /**
         * Checks if a phone number exists already
         * @param string $phone
         * @param DatabaseInterface $dbManager
         * @return bool
         */
        public static function doesPhoneNumberExist($phone, DatabaseInterface $dbManager){
            return UserTrait::doesExist($phone, "phone", $dbManager);
        }

        public static function doesExist($what, $columnName, DatabaseInterface $dbManager){
            $table = "user";
            $columns = [$columnName];
            $values = [$what];
            $result = $dbManager->query($table, $columns, "$columnName = ?", $values);

            if($result && count($result) > 0){
                return true;
            }
            return false;
        }

        /**
         * This method sends the confirmation email to the user.
         * The id and the email of the object should be set before this method is called.
         * include the phpmailer.inc.php file to make this function work
         */
        public static function sendConfirmationEmail($id, $email, DatabaseInterface $dbManager){
         
            $code = Utility::make6digitCode();

            if($dbManager->update("user", "ev_code = ?", [$code], "id = ?", [$id])){
                $sub = "Verify your email";
                $msg = "Your email verification code is $code";
    
                
                return (new EmailManager())->sendEmail($email, $email, $sub, $msg);
            }
            return false;
        }

        /**
         * Sends the confirmation SMS for a user
         */
        public static function sendConfirmationSms($id, $phone, DatabaseInterface $dbManager){
         
            $code = Utility::make6digitCode();

            if($dbManager->update("temporary_phone_number", "pv_code = ?", [$code], "userId = ?", [$id])){
                $msg = Constants::HALICARE.": your verification code is $code";
                return (new Sms($msg))->send($phone);
            }
            return false;
        }
        
        /**
         * Generate the six digits string
         * @param int $id - the ID of the user
         * @param string $appentTo - what will the six digits be appended to? e.g. PAT, DOC, MA
         */
        public static function generateUserName($id, $appendTo){
            $zeros = "";
            while(strlen("$zeros$id") < 6){
                $zeros .= "0";
            }

            return "$appendTo-$zeros$id";
        }

        /**
         * Gets the username from the ID such as PAT-000001
         */
        public static function getIdFromUserName($username){
            $parts = preg_split("/-/", $username);
            if(count($parts) < 2){
                return 0;
            }

            return (int)$parts[1];
        }

        /**
         * Gets the UserId assigned to specific user such as PATIENT,
         * DOCTOR, MED_ASSISTANT, MED_ADMIN, SYSTEM_ADMIN
         */
        public function getUserId(int $specificId, string $idColumn, string $fromTable)
        {
            $userInfo = (new DbManager())->query($fromTable, [User::USER_FOREIGN_ID], "$idColumn = ?", [$specificId]);

            if($userInfo === false) return 0;

            return $userInfo[User::USER_FOREIGN_ID];
        }
    }

?>