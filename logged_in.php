<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UFT-8">
		<title>Jeopardy: Logged in</title>
		<link rel="stylesheet" href="css/index.css"/>
		<link rel="stylesheet" href="css/logged_in.css"/>
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


		<?php if (login_check($mysqli) == true) : ?>
			<div id="content_loggedin">

				<div id="menubar">
					<ul>
						<li><a href="make-loggedin">Make a game</a></li>
						<li><a href="Jeopardy-loggedin">Play a game</a></li>
						<li><a href="manage-files">Manage files</a>
						<li><a href="account-settings">Account settings</a></li>
					</ul>

				</div>

				<div id="menu-content">
					<h1>Hello this is a test!</h1>

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
</html>