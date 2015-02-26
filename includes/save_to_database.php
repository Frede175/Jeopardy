<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	sec_session_start();

	if(login_check($mysqli) == true) {

		if(isset($_SESSION['user_id']) && isset($_POST['data'])) {
			$jsString = mysqli_escape_string($mysqli, json_decode(stripslashes($_POST['data'])));
			$dataArray = array();
			//A Test!!!!
			foreach($jsString as $d) {
				print_r('<p>' . $d . '</p>');
			}

			//Real stoff
			$i = 0;
			foreach ($jsString as $key => $value) {
				# code...
				$dataArray[$key] = $value;
				$i++;
			}
		}
	}
?>