<!DOCTYPE html>
<html>
	<head>
		<title>Jeopardy</title>
		<meta name="google-site-verification" content="p9vpD9lLHFicfer51IbBTg6WMyo2zVCjIRGXebeUto8" />
		<link rel="stylesheet" href="css/index.css"/>
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<LINK REL="SHORTCUT ICON" HREF="images/logo.png">
		
	</head>


	<body>
		<div id="header">
			<div id="nav">
				<ul>
					<li><a href="index">Home</a></li>
					<li><a href="make">Make</a></li>
					<li><a href="Jeopardy">Play</a></li>
					<li><a href="About">About</a></li>
					<img class="right" src="images/logo.png" id="logo">
					<a class="right" id="signup" href="register">Sign up</a>
					<a class="right" id="login" href="login">Login</a>
				</ul>
			</div>
		</div>

		<div id="content">
			
			<?php
				include_once 'includes/db_connect.php';
				include_once 'includes/verify.inc.php';
				
				$email = trim(mysqli_real_escape_string($mysqli, $_GET['email']));
				$key = trim(mysqli_real_escape_string($mysqli, $_GET['key']));

				if(isset($email) && isset($key)){

					if(check($email, $key, $mysqli) == true){
						echo '<h1 class="center">Account activated!</h1>';
						echo '<p><a href="login">Click here to login!</a></p>';
					}
					else
					{
						print_r(error_get_last());
						echo '<h1 class="center">There was a problem!</h1>';
					}
				}
				else
				{
					echo '<p class="error">FAIL!</p>';
				}
			?>
		</div>

	</body>
</html>