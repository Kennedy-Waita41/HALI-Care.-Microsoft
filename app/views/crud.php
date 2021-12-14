<!DOCTYPE html>
<html>

<head>
    <title>
        Hali Care
    </title>
    <link rel="stylesheet" href="static/css/main.css">
</head>

<body>

    <table>
        <tr>
            <td>
                <form onsubmit="event.preventDefault();onFormSubmit();" autocomplete="off">
                    <div>
                        <label>Patient Info*</label><label class="validation-error hide" id="patientinfoValidationError">This field is required.</label>
                        <input type="text" name="patientinfo" id="patientinfo">
                    </div>
                    <div>
                        <label>Diagnosis</label>
                        <input type="text" name="Diagnosis" id="Diagnosis">
                    </div>
                    <div>
                    <div>
                        <label>Prescription</label>
                        <input type="text" name="prescription" id="prescription">
                    </div>
                    
                        <label>Medication</label>
                        <input type="text" name="medication" id="medication">
                    </div>
                    <div  class="form-action-buttons">
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </td>
            <td>
                <table class="list" id="prescriptionlist">
                    <thead>
                        <tr>
                            <th>Patient Information</th>
                            <th>Diagnosis</th>
                            <th>Prescription </th>
                            <th>Medication</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <script src="js/crud.js"></script>
</body>

</html>