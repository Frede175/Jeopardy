<?php
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
?>


<div id="header">
	<div id="nav">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="make.php">Make</a></li>
			<li><a href="Jeopardy.php">Play</a></li>
			<li><a href="About.php">About</a></li>
			<img class="right" src="images/logo.png" id="logo">


			<?php if (login_check($mysqli) == true) : ?>
				<a class="right" id="logout" href="includes/logout.php">Logout</a>
				<a class="right" id="logged_in" href="logged_in.php">Account</a>
			<?php else : ?>
				<a class="right" id="signup" href="register.php">Sign up</a>
				<a class="right" id="login" href="login.php">Login</a>
			<?php endif; ?> 

			
		</ul>
	</div>
</div>