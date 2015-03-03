<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	sec_session_start();

	if(login_check($mysqli) == true) {
		if(isset($_SESSION['user_id']) && isset($_POST['data'])) {

			$dataArray = mysqli_escape_string($mysqli, $_POST['data']);

			$title = $dataArray['title'];
			$user_id = $_SESSION['user_id'];

			
			$prestmt = "SELECT user_id FROM save WHERE title = ? AND user_id = ? LIMIT 1";

			$stmt = $mysqli->prepare($prestmt);

			if ($stmt) {
        		$stmt->bind_param('si', $title, $user_id);
        		$stmt->execute();
        		$stmt->store_result();
 
        		if ($stmt->num_rows == 1) {
           			echo json_encode("A game with that title allready exists"); 
       			}
       			else
       			{
					$name = $dataArray['name'];
					$width = $dataArray['width'];
					$height = $dataArray['height'];
					$subjects = $dataArray['subjects'];
					$questions = $dataArray['questions'];
					$teams = $dataArray['teams'];
					$active = $dataArray['active'];
					$numteams = $dataArray['numteams'];
					$activeTeam = $dataArray['activeTeam'];
					$now = date("Y-m-d");

					$insert = "INSERT INTO save (user_id, name, width, height, subjects, questions, teams, active, numteams, activeTeam, data) VALUES ('$user_id', '$name', '$width', '$height', '$subjects', '$questions', '$teams', '$active', '$numteams', '$activeTeam', '$now'";
					if($mysqli->query($insert)) {
						echo json_encode("The game have been saved with the title of: " . $title);
					}
					else
					{
						echo json_encode("The game failed to save!");
					}
				}
			}
			else 
			{
				$error = "stmt failed" . error_get_last() . mysqli_stmt_error($stmt);
				echo json_encode($error);
			}
		}
		else
		{
			echo "isset failed!";
		}
	}
	else
	{
		echo "Not logged in!";
	}
?>