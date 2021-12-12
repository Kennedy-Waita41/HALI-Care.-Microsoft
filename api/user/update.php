<?php
    /**
     * Please send every data with the post request.
     * That is, all fields must be included.
     * first-name, last-name, email, phone, and profile-image.
     * the profile-image will be empty if not image was sent.
     */
    
    require("master.inc.php");
    require("auth.inc.php");

    $user = new User();

    $user->loadUser($userId);

    $message = "";
    $response = new Respond();
    $response->build("OK");

    $updateSqlStr = "";
    $newValues = [];

    $firstName = Utility::sanitizeString($_POST["firstname"]);
    $lastName = Utility::sanitizeString($_POST["lastname"]);
    $dob = Utility::sanitizeString($_POST["dob"]);
    
    if(!empty($firstName) && $firstName != $user->getFirstName()){
        if(!Utility::checkName($firstName)){
            exit(Respond::UNE());
        }

        $updateSqlStr .= "firstname = ?";
        $newValues[] = $firstName;
    }

    if(!empty($lastName) && $lastName != $user->getLastName()){
        if(!Utility::checkName($lastName)){
            exit(Respond::UNE());
        }

        if(count($newValues) > 0){
            $updateSqlStr .= ", ";
        }

        $updateSqlStr .= "lastname = ?";
        $newValues[] = $lastName;
    }

    if(!empty($dob)){
        $dob = Utility::toDate($dob);
        if(!Utility::isDate($dob)){
            exit(Respond::UDE());
        }

        if(count($newValues) > 0){
            $updateSqlStr .= ", ";
        }

        $updateSqlStr .= "dob = ?";
        $newValues[] = $dob;
    }

    
   
    if(count($_FILES) > 0 && isset($_FILES['profile-image'])){
        $profileImage = $_FILES['profile-image'];
        if(!Utility::isImage($profileImage['tmp_name'])){
            exit(Respond::IIE());
        }

        $updating = false;
        $oldProfileImage = "";
        if($user->getProfileImage() != User::DEFAULT_AVATAR){
            $updating = true;
            $oldProfileImage = $user->getProfileImage();
        }

        $newProfileImage = Utility::uploadImage($profileImage, $user->getId(), User::PROFILE_IMG_PATH);
        Utility::setUpdatedOnToNow(User::USER_TABLE, USER::USER_ID, $user->getId());

        if($newProfileImage !== false){
            if(count($newValues) > 0){
                $updateSqlStr .= ", ";
            }
    
            $updateSqlStr .= "profile_image = ?";
            $newValues[] = $newProfileImage;

        }else{
            $response->addMessage("An error occurred while uploading your profile picture.");
        }
    }

    $email = $_POST['email'];

    $dbManager = new DbManager();

    if(!empty($email) && $email != $user->getEmail()){
        if(!Utility::checkEmail($email)){
            exit(Respond::UEE());
        }

        if(User::doesEmailExist($email, $dbManager)){
            exit(Respond::EEE());
        }

        $dbManager->delete("temporary_email", User::USER_FOREIGN_ID." = ?", [$user->getId()]);

        if($dbManager->insert("temporary_email", [User::USER_FOREIGN_ID.", email"], [$user->getId(), $email]) != -1
         && User::sendConfirmationEmail($user->getId(), $email, $dbManager)
         ){
            $response->addMessage("We have sent a confirmation email to $email.");
        }
    }

    $phone = $_POST['phone'];

    if(!empty($phone) && $phone != $user->getPhone()){

        if(!Utility::checkPhone($phone)){
            exit(Respond::UQPNE());
        }

        if(User::doesPhoneNumberExist($phone, $dbManager)){
            exit(Respond::PNEE());
        }

        $dbManager->delete("temporary_phone_number", "userId = ?", [$user->getId()]);

        if($dbManager->insert("temporary_phone_number", ["userId, phone"], [$user->getId(), $phone]) != -1
         && User::sendConfirmationSms($user->getId(), $phone, $dbManager)
         ){
            $also = ($message == "") ? "": 'also';
            $response->addMessage("We sent an sms to verify your new phone number $also.");
        }
    }

    if(!(empty($updateSqlStr) || $dbManager->update("user", $updateSqlStr, $newValues, "id = ?", [$user->getId()]))){
        exit(Respond::SQE());
    }

    $user->refresh();
    $respond = json_encode([
        "token" => "$userId-$token",
        "firstname" => $user->getFirstName(),
        "lastname" => $user->getLastName(),
        "email" => $user->getEmail(),
        "profileImage" => User::PROFILE_IMG_PATH."/". $user->getProfileImage(),
        "message" => $response->getMessage()
    ]);

    exit(Respond::makeResponse("OK", $respond));

    

?>