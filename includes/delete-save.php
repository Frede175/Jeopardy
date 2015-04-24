<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	sec_session_start();

	$name = mysqli_escape_string($mysqli, htmlentities($_GET['name']));
	$type = mysqli_escape_string($mysqli, htmlentities($_GET['type']));

		print_r(error_get_last());

	if($type == "save" || $type == "template") {
		if (login_check($mysqli) == true) {
			$id = $_SESSION['user_id'];
			$deleteprep = "DELETE FROM $type WHERE name='$name' AND user_id='$id'";

					print_r(error_get_last());


			if($mysqli->query($deleteprep) === TURE) {
				header('Location: ../manage-files?error=none');
			}
			else
			{
						header('Location: ../manage-files?error=did not delete anything' . error_get_last());
						print_r(error_get_last());
			}

		}
		else
		{
			header('Location: ../manage-files?error=not loggedin');
					print_r(error_get_last());
		}
	}
	else
	{
		header('Location: ../manage-files?error=not');
		print_r(error_get_last());
		
	}

	
?>