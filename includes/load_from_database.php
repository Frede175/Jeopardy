<?php


		include_once 'includes/db_connect.php';
		include_once 'includes/functions.php';

		sec_session_start();


		if(login_check($mysqli) == true) {

			$gamefile = '';
			$game_type = '';
		
			if(isset($_SESSION['user_id']) && isset($_SESSION['game_name']) && isset($_SESSION['game_type'])) {
				$user_id = $_SESSION['user_id'];
				$name = $_SESSION['game_name'];
				$game_type = $_SESSION['game_type'];
				unset($_SESSION['game_name']);
				unset($_SESSION['game_type']);

				if($game_type === 'template') {
					$querystr = "SELECT name, width, height, subjects, questions FROM template WHERE user_id='$user_id' AND name='$name'";
				}	
				elseif ($game_type === 'save') {
					$querystr = "SELECT name, width, height, subjects, questions, teams, numteams, activeteam, active FROM save WHERE user_id='$user_id' AND name='$name' LIMIT 1";
				}


				print_r(error_get_last());
				$game = array();

				if($stmt = $mysqli->query($querystr)) {
					$row = mysqli_fetch_assoc($stmt);
					$game['name'] = $row['name'];
					$game['width'] = $row['width'];
					$game['height'] = $row['height'];
					$game['subjects'] = $row['subjects'];
					$game['questions'] = $row['questions'];
					print_r(error_get_last());
					if($game_type === 'save') {
						$game['teams'] = $row['teams'];
						$game['active'] = $row['active'];
						$game['numteams'] = $row['numteams'];
						$game['activeteam'] = $row['activeteam'];
						print_r(error_get_last());
					}

					if(!empty($game)) {
						$game['true'] = true;
						$gamefile = json_encode($game);
					}
					else
					{
						loadFail();
					}
				}
				else
				{
					loadFail();
				}
			}
			else
			{
				loadFail();
			}
	
		}
		else
		{
		 	loadFail();
		}

	function loadFail() {
		$gamefile = '{"true":"false"}';
		$game_type = 'type';
	}

?>