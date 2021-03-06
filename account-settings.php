<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UFT-8">
		<title>Jeopardy: Account settings</title>
		<link rel="stylesheet" href="css/index.css"/>
		<link rel="stylesheet" href="css/logged_in.css"/>
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<LINK REL="SHORTCUT ICON" HREF="images/logo.png">

		<script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
	</head>

	<body>

	
		<?php include_once 'views/header.php'; ?>


		<?php if (login_check($mysqli) == true) : ?>
			<div id="content_loggedin">

				<?php include_once 'views/menubar.php'; ?>

				<div id="menu-content">
					<h1 class="center">Welcome <?php echo htmlentities($_SESSION['username']); ?></h1>
					<h2 class="center">Account settings</h2>

					<form action="includes/update.php" method="post" name="update_email_form">
						<h4>Email</h4>

						<p>Your curent email is: <?php echo htmlentities($_SESSION['email']); ?></p>
						<p>New email: <input type="text" name="email" placeholder="New email" id="email" /></p>

						<input type="button" value="Update" onclick="if(this.form.email.value != ''){submit();}"/>
					</form>


					<form action="includes/update.php" method="post" name="update_password_form">
						<h4>Password</h4>

						<p>Old password: <input type="password" name="password_old" id="password_old" /></p>
						<p>New password: <input type="password" name="password_new1" id="password_new1" /></p>
						<p>New password: <input type="password" name="password_new2" id="password_new2" /></p>

						<input type="button" value="Update" onclick="return updateformhash(this.form, this.form.password_old, this.form.password_new1, this.form.password_new2);"/>
					</form>


				</div>

			</div>
		
		<?php else : ?>
			<div class="error">
				<p>
					<span>You need to login to get access to this page!</span>
				</p>
			</div>
		<?php endif; ?> 	
	</body>
</html