<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Jeopardy: register</title>
		<link rel="stylesheet" href="css/index.css"/>
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<LINK REL="SHORTCUT ICON" HREF="images/logo.png">
		<script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>

	</head>

	<body>

		<div id="header">
			<div id="nav">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="make.php">Make</a></li>
					<li><a href="Jeopardy.php">Play</a></li>
					<li><a href="About.php">About</a></li>
					<img class="right" src="images/logo.png" id="logo">
					<a class="right" id="signup" href="register.php">Sign up</a>
					<a class="right" id="login" href="login.php">Login</a>
				</ul>
			</div>
		</div>


		<div id="content">

			<?php
				include_once 'includes/register.inc.php';
				include_once 'includes/functions.php';
			
				if(!empty($error_msg)) {
					echo $error_msg;
				}
			?>	

			<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="register_form">
				Username: <input type="text" name="username" id="username"/><br>
				Email: <input type="text" name="email" id="email" /><br>
	            Password: <input type="password"
	                             name="password" 
	                             id="password"/><br>
	            Confirm password: <input type="password" 
	                                     name="confirmpwd" 
	                                     id="confirmpwd" /><br>
	            <input type="button" value="Register" onclick="return regformhash(this.form,
	                this.form.username,
	                this.form.email,
	                this.form.password,
	                this.form.confirmpwd);" /> 
					

			</form>

		</div>

	</body>
</html>