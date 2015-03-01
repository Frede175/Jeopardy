<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	sec_session_start();

	if(login_check($mysqli) == true) {
		if(isset($_SESSION['user_id']) && isset($_POST['data'])) {

			$dataArray = mysqli_escape_string($mysqli, $_POST['data']);

			

			echo json_encode($jsString['title']);
		}
	}
?>