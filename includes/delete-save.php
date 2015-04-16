<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	sec_session_start();

	$name = mysqli_escape_string($mysqli, htmlentities($_GET['name']));
	$type = mysqli_escape_string($mysqli, htmlentities($_GET['type']));

		print_r(error_get_last());

	if($type != "save" || $type != "template") {
		print_r(error_get_last());
	}
	else
	{
		if (login_check($mysqli) == true) {
			$deleteprep = "DELETE FROM " . $type . " WHERE name=" . $name . " AND id=" . $_SESSION['id'];
			echo $deleteprep;

					print_r(error_get_last());


			if($mysqli->qurry($deleteprep) === TURE) {
				header('Location: ../manage-files');
			}
			else
			{
						print_r(error_get_last());
			}

		}
		else
		{
					print_r(error_get_last());
		}
	}

	
?>