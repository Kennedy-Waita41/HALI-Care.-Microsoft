<?php  include('../config.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Averia+Serif+Libre|Noto+Serif|Tangerine" rel="stylesheet">
<!-- Font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<!-- ckeditor -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>
<!-- Styling for public area -->
<link rel="stylesheet" href="../static/css/user_styling.css">
	<title>User Feedback</title>
</head>
<body>
	<?php include(ROOT_PATH . '/Patients/includes/navbar.php') ?>
<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/Patients/includes/menu.php') ?>
		<form action="">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name">

                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>

                    <input type="submit" class="create_btn" value="Send message">
                </form>

		</div>
      




</body>
</html>