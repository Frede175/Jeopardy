<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	sec_session_start();

	if(isset($_POST['email'], $_POST['p'])) {
		$email = $_POST['email'];
		$password = $_POST['p'];

		if(login($email, $password, $mysqli) == true) {
			//Login seccess!!!!!
			header('Location: ../logged_in');
			exit();
		}
		else
		{
			exit();
		}
	}
	else
	{
		echo 'Invalid Request';
	}
?>