<?php  include('../config.php'); ?>
<?php include(ROOT_PATH . '/Patients/includes/head_section.php'); ?>
	<title>Patient consultation</title>
</head>
<body>
<!-- User navbar -->
	<?php include(ROOT_PATH . '/Patients/includes/navbar.php') ?>
	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/Patients/includes/menu.php') ?>
		<div class="action">
		<h1 class="page-title">Request A virtual consultation</h1>

         <form method="post" action="<?php echo BASE_URL . 'Patients/Consult_booking.php'; ?>" >
		 <select class="role"  name="reason">
			          <option value="" selected disabled>Reason for consultation</option>
			        <option value="Unwell">I am feeling sick(Unwell)</option>
					<option value="appointment">I have a doctor's appointment</option>
					<option value="Consultation">To consult healthcare practitioner</option>
					<option value="4Other">Other</option>

	          </select>
			<input type="text" name="Symptoms" value="" placeholder="Enter the symptoms here">
			<select class="role"  name="when_start">
			          <option value="" selected disabled>Date Symptoms started</option>
			        <option value="Today">Today</option>
			         <option value="Yesterday">Yesterday</option>
			          <option value="week">In the Last One week</option>
					  <option value="more">Two weeks ago</option>
					  <option value="month">Last Month</option>
					  <option value="earlier">Earlier than a Month ago</option>
	          </select>
			<input type="text" name="Medication" placeholder="Enter Current Medication">
		    <input type="text" name="Allergies" placeholder="Enter Any allergies to medication">
		    <button type="submit"  class="btn" name="create_btn"><a href="ticket.php" > Consultation</a></button>
			<button type="submit"  class="btn" name="create_btn">Cancel</button>
		
		</div>
	</div>

<script>
    document.getElementById("menu_bars").style.visibility = "hidden";
    document.getElementById("edit-profile").style.visibility = "hidden";
    document.getElementById("page-title").innerHTML = "hali_care: Consult_booking"
</script>
<?php
    include(ROOT_PATH . '/Patients/includes/scripts.inc.php');
?>
<footer>
     <script src='static/js/consult_booking.js'></script>
</footer>
</body>
</html>