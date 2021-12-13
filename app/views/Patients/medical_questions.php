<?php  include('../config.php'); ?>
<?php include(ROOT_PATH . '/Patients/includes/head_section.php'); ?>
	<title>View Booking</title>
</head>
<body>
<!-- patient navbar -->
	<?php include(ROOT_PATH . '/Patients/includes/navbar.php') ?>

	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/Patients/includes/menu.php') ?>

		<!-- Display records from DB-->
		<!-- Display notification message -->
		<div class="table-div"  style="width: 80%;">
			
			<?php include(ROOT_PATH . '/includes/messages.php') ?>
			<center><h1 class="page-title" style= "text-align: center;">Perform symptom Check</h1></center>
			<form method="post" action="<?php echo BASE_URL . 'Patients/medical_questions.php'; ?>" >
			<select class="role"  name="sMode">
			          <option value="" selected disabled>Select Symptoms we can help you with</option>
			        <option value="Unwell">Headache</option>
					<option value="appointment">Pain</option>
					<option value="Consultation">Vomiting</option>
					<option value="Consultation">Abnormal temperatures</option>
					<option value="4Other">Other</option>
	          </select>
			  <input type="text"name="description" placeholder="Brief description">
			  <button type="submit" class="btn" name="create_btn">SUBMIT</button>
			 <button type="submit" class="btn" name="create_btn">Clear</button>

</body>
</html>