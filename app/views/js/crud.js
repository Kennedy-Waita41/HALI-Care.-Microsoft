var selectedRow = null

function onFormSubmit() {
    if (validate()) {
        var formData = readFormData();
        if (selectedRow == null)
            insertNewRecord(formData);
        else
            updateRecord(formData);
        resetForm();
    }
}

function readFormData() {
    var formData = {};
    formData["patientinfo"] = document.getElementById("patientinfo").value;
    formData["Diagnosis"] = document.getElementById("Diagnosis").value;
    formData["prescription"] = document.getElementById("prescription").value;
    formData["medication"] = document.getElementById("medication").value;
    return formData;
}

function insertNewRecord(data) {
    var table = document.getElementById("prescriptionlist").getElementsByTagName('tbody')[0];
    var newRow = table.insertRow(table.length);
    cell1 = newRow.insertCell(0);
    cell1.innerHTML = data.patientinfo;
    cell2 = newRow.insertCell(1);
    cell2.innerHTML = data.Diagnosis;
    cell3 = newRow.insertCell(2);
    cell3.innerHTML = data.medication;
    cell4 = newRow.insertCell(3);
    cell4.innerHTML = data.medication;
    cell4 = newRow.insertCell(4);
    cell4.innerHTML = `<a onClick="onEdit(this)">Edit</a>
                       <a onClick="onDelete(this)">Delete</a>`;
}

function resetForm() {
    document.getElementById("patientinfo").value = "";
    document.getElementById("Diagnosis").value = "";
    document.getElementById("medication").value = "";
    document.getElementById("medication").value = "";
    selectedRow = null;
}

function onEdit(td) {
    selectedRow = td.parentElement.parentElement;
    document.getElementById("patientinfo").value = selectedRow.cells[0].innerHTML;
    document.getElementById("Diagnosis").value = selectedRow.cells[1].innerHTML;
    document.getElementById("medication").value = selectedRow.cells[2].innerHTML;
    document.getElementById("medication").value = selectedRow.cells[3].innerHTML;
}
function updateRecord(formData) {
    selectedRow.cells[0].innerHTML = formData.patientinfo;
    selectedRow.cells[1].innerHTML = formData.Diagnosis;
    selectedRow.cells[2].innerHTML = formData.medication;
    selectedRow.cells[3].innerHTML = formData.medication;
}

function onDelete(td) {
    if (confirm('Are you sure to delete this record ?')) {
        row = td.parentElement.parentElement;
        document.getElementById("prescriptionlist").deleteRow(row.rowIndex);
        resetForm();
    }
}
function validate() {
    isValid = true;
    if (document.getElementById("patientinfo").value == "") {
        isValid = false;
        document.getElementById("patientinfoValidationError").classList.remove("hide");
    } else {
        isValid = true;
        if (!document.getElementById("patientinfoValidationError").classList.contains("hide"))
            document.getElementById("patientinfoValidationError").classList.add("hide");
    }
    return isValid;
}