let firstname = document.getElementById("firstname"),
    lastname = document.getElementById("lastname"),
    password = document.getElementById("user_password"),
    confirmPassword = document.getElementById("c-password"),
    patientUsername = document.getElementById("patient_username");

function register(){
    if(password.value != confirmPassword.value){
        showError("Passwords do not match");
        return;
    }
    let formData = buildFormData ({'firstname':firstname.value, 'lastname':lastname.value, 'password':password.value})

    makeRequest("patient/add.php", formData, checkResult, false, true);
}

function checkResult(response){
    if(response.status != "OK"){
        showError(response.message);
        return;
    }
    let patient = JSON.parse (response.message);
    patientUsername.innerHTML = `Your username is `+patient.username;

    //location.href = 'login.php'
}