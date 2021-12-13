let reason = document.getElementById("reason"),
    Symptoms = document.getElementById("Symptoms"),
    when_start = document.getElementById("when_start"),
    Medication = document.getElementById("Medication"),
    Allergies = document.getElementById("Allergies");


function consult(){
    let formData = new FormData();
    formData.append("reason", reason.value);
    formData.append("Symptoms", Symptoms.value);
    formData.append("when_start", when_start.value);
    formData.append("Medication", Medication.value);
    formData.append("Medication", Medication.value);

    makeRequest("patients/Consult_booking.php", formData, checkResult);
}

function checkResult(response){
    if(response.status != "OK"){
        showError(response.message);
        return;
    }

    window.localStorage.setItem("user", response.message);
    location.href = "P_user.php";
}