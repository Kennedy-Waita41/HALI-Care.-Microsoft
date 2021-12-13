<?php  include('../config.php'); ?>
<?php include(ROOT_PATH . '/Patients/includes/head_section.php'); ?>
<?php/* include(ROOT_PATH . '/Patients/includes/user_function.php'); */?>
	<title>Patient</title>
</head>
<body>
	<!-- PUser navbar -->
	<?php include(ROOT_PATH . '/Patients/includes/navbar.php') ?>
	<div class="container content" style="width: 100%;padding: 40px">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/Patients/includes/menu.php') ?>
		<!-- Account  -->
		<div class="action">
			<h1 class="page-title">Ticket Number</h1>
			<?php include '../../components/notification.php' ?>
			<form method="post" action="<?php echo BASE_URL . 'Patients/P_user.php'; ?>" >
            <h2 id="Ticket-number">Ticketnumber</h2>

				<button type="button" class="btn" name="craete_btn" onclick="newTicket()">New Consultation</button>
				<button type="button" class="btn" name="craete_btn" onclick="chatbot()"><a href="https://healthcare-bot-zg7w6qp64uv4e.azurewebsites.net"> Add symptoms</a></button>
				
			</form>
		</div>
</div>
<script src= "../js/general.js"></script>

<script src="../js/ticket.js"></script>
</body>
</html>