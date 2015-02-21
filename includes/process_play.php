<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	sec_session_start();

	$name = mysqli_escape_string($mysqli, htmlentities($_GET['name']));
	$type = mysqli_escape_string($mysqli, htmlentities($_GET['type']));

	if(isset($_SESSION['user_id'])) {
		$_SESSION['game_name'] = $name;
		$_SESSION['game_type'] = $type;
		header('Location: ../Jeopardy');
	}
	else
	{
		echo '<p>Error</p>';
	}

?>