<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';

	sec_session_start();

	if(login_check($mysqli) == true) {
		$logged = 'in';
	}
	else
	{
		 $logged = 'out';
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Jeopardy: login</title>
		<link rel="stylesheet" href="css/index.css"/>
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
				if(isset($_GET['error'])) {
					echo '<p class="error">Error logging in!<p/>';
				}
			?>
			<form action="includes/process_login.php" method="post" name="login_form">                      
            Email: <input type="text" name="email" />
            Password: <input type="password" 
                             name="password" 
                             id="password"/>
            <input type="button" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password);" /> 
        </form>
 
			<?php
        		if (login_check($mysqli) == true) {
                    echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
            		echo '<p>Do you want to change user? <a href="includes/logout.php">Log out</a>.</p>';
        		} 
        		else 
        		{
                    echo '<p>Currently logged ' . $logged . '.</p>';
                    echo "<p>If you don't have a login, please <a href='register.php'>register</a></p>";
                }
			?>  


		</div>

	</body>
</html>