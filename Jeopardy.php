<?php


		include_once 'includes/db_connect.php';
		include_once 'includes/functions.php';

		sec_session_start();
		
		if(isset($_SESSION['user_id']) && isset($_SESSION['game_name']) && isset($_SESSION['game_type'])) {
			$user_id = $_SESSION['user_id'];
			$name = $_SESSION['game_name'];
			$type = $_SESSION['game_type'];
			unset($_SESSION['game_name']);
			unset($_SESSION['game_type']);

		if($type === 'template') {
			$querystr = "SELECT name, width, height, subjects, questions FROM template WHERE user_id='$user_id' AND name='$name'";
		}	
		elseif ($type === 'save') {
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
				if($type === 'save') {
					$game['teams'] = $row['teams'];
					$game['active'] = $row['active'];
					$game['numteams'] = $row['numteams'];
					$game['activeteam'] = $row['activeteam'];
					print_r(error_get_last());
				}

				if(!empty($game)) {
					$gamefile = json_encode($game);
				}
				else
				{
					$gamefile = '';
				}
			}
			else
			{
				$gamefile = '';
			}
		}
		else{
			$gamefile = '';
		}
	

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Jeopardy</title>


		<link rel="stylesheet" href="css/main.css"/>
		<link rel="stylesheet" href="css/menu-animation.css"/>
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="css/jquery-ui.css"/>
		<LINK REL="SHORTCUT ICON" HREF="images/logo.png">
	</head>

	<body>


		<div id="popup">
			<img src="images/close.png" id="close">

			<div id="load-game-popup" class="popup">
				<h1>Load Save file</h1>
				<input class="center" type="file" name="FileChoser" id="loadState"/>
			</div>

			<div id="new-game-popup" class="popup">
				<h1>New game</h1>
				<h3 class="center">This generates a jeopardy with generated questions and answers</h3>
				<div class="select-newgame">
					<table>
						<tr>
							<td><P>The number of teams:  </P></td>
							<td class="select-style"><select id="teams-number" class="select_lists-8"></select></td>
						</tr>
							
						<tr>
							<td><p>The number of subjects:  </p></td>
							<td class="select-style"><select id="subjects-number" class="select_lists-8"></select></td>
						</tr>
						
						<tr>
							<td><p>The number of questions:  </p></td>
							<td class="select-style"><select id="questions-number" class="select_lists-10"></select></td>
						</tr>
						
						
					</table>
					<button id="submit-newgame" class="center">Make new game!</button>
				</div>
			</div>

			<div id="teams-popup" class="popup">
				<div id="teams-popup-start">
					<h1 class="center">New game from template!</h1>
					<div class="select-newgame">
						<table>
							<tr>
								<td><P>Select number of teams:  </P></td>
								<td class="select-style"><select id="teams-number-team" class="select_lists-8"></select></td>
							</tr>
						</table>
					</div>
					<button id="submit-teams-continue" class="center">Continue</button>
				</div>
				<div id="teams-popup-end" style="display:none">
					<h1 class="center">Team names!</h1>
					<div id="teams-name-append" class="center">
						
					</div>

					<button id="submit-newgame-teams" class="center">Start the game!</button>
				</div>
			</div>
		</div>

		<div id="dimmer"></div>
			
		<div>
			<img src="images/menu.png" id="menu">

			<div id="div-menu">
				<ul>
					<li><a href="index">Home</a></li>
					<li><a href="make">Make</a></li>
					<li><a href="Jeopardy">Play</a></li>
					<li><a href="About">About</a></li>
				</ul>
				<ul id="ul-border"> 
					<li><a href="#" id="new-game">New game</a></li>
					<li><a href="#" id="save-game">Save game</a></li>
					<li><a href="#" id="load-game">Load game</a></li>
				</ul>

			</div>
		</div>

		<p id="title" style="display: none">Title</p>
		<div id="teams_points">
			<table>
				<tbody>
					<tr id="teams_tr">

					</tr>
				</tbody>
			</table>
		</div>
		
		<div id="teams_table">
			<table class="fixed">
				<tbody id="main_table" style="display:">

				</tbody>

			</table>
<!--
			<button id="newGame">New Game</button>
			<button id="saveState">Save</button>
			<br>
			Load saved game:
			<input type="file" id="loadState">
-->
		</div>

		<div id="Questions" style="display:none" class="center">

			<p class="timer">Time left: <p id="timer_countdown" class="timer">0</p></p>

			<h1 id="Question">Question not loaded</h1>

			<button id="btn_right" class="Qbtn">Right</button>
			<button id="btn_wrong" class="Qbtn">Wrong</button>
					
			<h1 id="Answer" style="display:none">Answer not loaded</h1>

			<button id="continue" class="Qbtn" style="display:none">Continue</button>

		</div>


		<!-- Footer --> 
		<div id="background-madeby">
			<p>Background is by <a href="http://www.squidfingers.com/patterns" target="_blank">Squidfingers</a></p>
		</div>

		<!--Script -->

		<script type="text/javascript" src="js/jquery-latest.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/FileSaver.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>
		<script> 
			var game = <?php echo $gamefile; ?>;
			var game_type = <?php echo $game_type; ?>;
		</script>
		<script type="text/javascript" src="js/app.js"></script>
	</body> 
</html>