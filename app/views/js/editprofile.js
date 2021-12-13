var firstname = document.getElementById("firstname"),
    lastname = document.getElementById("lastname"),
    email = document.getElementById("email"),
    phone = document.getElementById("phone"),
    dob = document.getElementById("dob"),
    profileImage = document.getElementById("profile-image"),
    profileImageInput = document.getElementById("profile-image-input"),

    oldPassword = document.getElementById("old-password"),
    newPassword = document.getElementById("new-password"),
    cPassword = document.getElementById("c-password");

let cUser = JSON.parse(localStorage.getItem("user"));

firstname.value = cUser.firstname;
lastname.value = cUser.lastname;
email.value = cUser.email;
phone.value = cUser.phone;
dob.value = cUser.dob;

profileImage.src = getFullStorageLink(cUser.profileImage);

function uploadImage(){
    
    if(!profileImageInput.files[0]){
        showError("No Image Selected");
        return;
    }

    let formData = buildFormData({
        "firstname": firstname.value,
        "lastname": lastname.value,
        "email": email.value,
        "phone": phone.value,
        "dob": dob.value,
        "profile-image": profileImageInput.files[0]
    });

    makeRequest("user/update.php", formData, loadImage, false, false);
}

function loadImage(response){
    if(response.status != "OK"){
        showError(response.message);
        return;
    }

    let link = JSON.parse(response.message).profileImage;
    profileImage.src =  getFullStorageLink(link);

    let user = JSON.parse(localStorage.getItem("user"));
    user.profileImage = link;

    window.localStorage.setItem("user", JSON.stringify(user));
    setUpNav();
    return;
}

function updateProfile(){
    console.log (dob.value);
    let formData = buildFormData({ 
        "firstname": firstname.value,
        "lastname": lastname.value,
        "email": email.value,
        "phone":phone.value,
        "dob": dob.value
    });
    makeRequest("user/update.php", formData, updateUser);
}

function updateUser(json){
    if(json.status != "OK"){
        showError(json.message);
        return;
    }

    showSuccess("successfully updated your profile");
    console.log (json.message);
    localStorage.setItem("user", json.message);
    location.href="Patients/ticket.php"
    
    return;
}

function resetPassword(){
    if(oldPassword.value.length < 1){
        showError("To change your password, enter the old password");
        return;
    }
    if(newPassword.value != cPassword.value){
        showError("The passwords do not match");
        return;
    }

    let formData = buildFormData({
        "old-password": oldPassword.value,
        "new-password": newPassword.value
    });
    
    makeRequest("user/resetPassword.php", formData, (response) => {
        if(response.status != "OK"){
            showError(response.message);
            return;
        }

        showSuccess(response.message);

    });
}