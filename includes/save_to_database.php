<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	sec_session_start();

	if(login_check($mysqli) == true) {
		if(isset($_SESSION['user_id']) && isset($_POST['data'])) {

			$dataArray = $_POST['data'];

			$title = escapeVar($dataArray['title']);
			$user_id = $_SESSION['user_id'];
			$state = escapeVar($dataArray['state']);

			
			$prestmt = "SELECT user_id FROM save WHERE (name = ?) AND (user_id = ?) LIMIT 1";

			if ($stmt = $mysqli->prepare($prestmt)) {

        		$stmt->bind_param("si", $title, $user_id);
        		$stmt->execute();
        		$stmt->store_result();
 
        		if ($stmt->num_rows == 1) {
           			echo json_encode("A game with that title allready exists"); 
       			}
       			else
       			{
       				$stmt->close();
					$name = escapeVar($dataArray['title']);
					$width = $dataArray['width'];
					$height = $dataArray['height'];
					$subjects = $dataArray['subjects'];
					$questions = $dataArray['questions'];
					$now = date("Y-m-d");

					//Checking if it's a template save or game save!
					if($state == 1) {
						$teams = $dataArray['teams'];
						$active = $dataArray['active'];
						$numteams = $dataArray['numteams'];
						$activeTeam = $dataArray['activeTeam'];
						$insert = "INSERT INTO `save` (`user_id`, `name`, `width`, `height`, `subjects`, `questions`, `teams`, `active`, `numteams`, `activeteam`, `date`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
					}
					elseif ($state == 0) {
						$insert = "INSERT INTO `template` (`user_id`, `name`, `width`, `height`, `subjects`, `questions`, `date`) VALUES (?,?,?,?,?,?,?)";
					}

					
					if($insert_stmt = $mysqli->prepare($insert)) {
						if($state == 1) {
							$insert_stmt->bind_param("isiissssiis", $user_id, $name, $width, $height, $subjects, $questions, $teams, $active, $numteams, $activeTeam, $now);
						}
						elseif ($state == 0) {
							$insert_stmt->bind_param("isiisss", $user_id, $name, $width, $height, $subjects, $questions, $now);
						}

						if($insert_stmt->execute()) {
							echo json_encode("The game have been saved with the title of: " . $title);
						}
						else
						{
						$error = error_get_last();
						echo json_encode(mysqli_stmt_error($insert_stmt));
						}
						
					}
					else
					{
						$error = error_get_last();
						echo json_encode($error);
					}
				}
			}
			else 
			{
				$error = error_get_last();
				echo json_encode(mysqli_stmt_error($stmt));
			}
		}
		else
		{
			echo json_encode("isset failed!");
		}
	}
	else
	{
		echo json_encode("Not logged in!");
	}


	function escapeVar($var) {
		GLOBAL $mysqli;

		$var = mysqli_real_escape_string($mysqli, $var);
		return $var;
	}
?>