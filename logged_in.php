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
		<?php include_once 'views/header.php'; ?>


		<?php if (login_check($mysqli) == true) : ?>
			<div id="content_loggedin">

				<?php include_once 'views/menubar.php'; ?>

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