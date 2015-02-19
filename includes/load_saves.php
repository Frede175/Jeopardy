<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	sec_session_start();

	$user_id = $_SESSION['user_id'];

	if($stmt = $mysqli->query("SELECT name, width, height FROM save WHERE id='$user_id' LIMIT 3")) {
		while($row = mysqli_fetch_assoc($stmt)) {
			$savedb['name'] = $row['name'];
			$savedb['width'] = $row['width'];
			$savedb['height'] = $row['height'];

		}

		if($savedb) {
			
		}
		else
		{

		}

	}
	else
	{

	}
?>