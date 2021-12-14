<!DOCTYPE html>
<html>

<head>
    <title>
        Hali Care
    </title>
    <link rel="stylesheet" href="static/css/admin_styling.css">
    <link rel="stylesheet" href="static/css/main.css">
</head>


<body>
	<!-- admin navbar -->
	<?php include( 'admin/includes/navbar.php') ?>
	<div class="container content">
		<!-- Left side menu -->
		<?php include( 'admin/includes/menu.php') ?>
		<!-- Middle form - to create and edit  -->
        
		<div class="action">
			<h1 class="page-title">Add| Prescription</h1>



				<!-- if editing user, the id is required to identify that user -->
                <form onsubmit="event.preventDefault();onFormSubmit();" autocomplete="off">
                    <div>
                        <label>PA-Ticket No.*</label><label class="validation-error hide" id="patientinfoValidationError">This field is required.</label>
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


		<div class="table-div">
				<table class="table" class="list" id="prescriptionlist">
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
		</div>
</div>
		<!-- // Display records from DB -->
	</div>
    <script src="js/crud.js"></script>
</body>
</html>
