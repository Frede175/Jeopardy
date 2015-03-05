<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';

	sec_session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Jeopardy</title>
		<link rel="stylesheet" href="css/index.css"/>
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<LINK REL="SHORTCUT ICON" HREF="images/logo.png">
		
	</head>


	<body>
		<?php include_once 'views/header.php'; ?>
		<div id="content">
			<h1>Welcome to Jeopardy Webs</h1>
			<h2>The site were you can create jeopardys in any size you want!</h2>
		</div>


	</body>

</html>