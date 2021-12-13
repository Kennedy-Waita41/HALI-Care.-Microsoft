let patientUsername= document.getElementById('patient_username');
let password= document.getElementById('user_password');

function login() {
    let formData= buildFormData({"username": patientUsername.value, "password": password.value});
    
    makeRequest("user/login.php",formData,loginCallBack, true, false);
}
function loginCallBack(json) {
    if(json.status != "OK"){
        showError(json.message);
        return;
    }
    showSuccess("Successfully Logged In"); // Just for a time being, until we get the UI pages
    localStorage.setItem("user", json.message);
    location.href='edit_profile.php'
    
    return;
}