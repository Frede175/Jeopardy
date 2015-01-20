<!DOCTYPE html>
<html>
	<head>
		<title>Jeopardy</title>


		<link rel="stylesheet" href="css/main.css"/>
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
	</head>

	<body>
		<div id="TEAMS_points">
			<table>
				<tbody>
					<tr id="TEAMS_tr">

					</tr>
				</tbody>
			</table>
		</div>
		
		<div id="TEAMS_table">
			<table>
				<tbody id="main_table" style="display:">

				</tbody>

			</table>

			<button id="newGame">New Game</button>
			<button id="saveState">Save</button>
			<br>
			Load saved game:
			<input type="file" id="loadState">

		</div>

		<div id="Questions" style="display:none" class="center">

			<p class="Timer">Time left: <p id="timer_countdown" class="Timer">0</p></p>

			<h1 id="Question">Question not loaded</h1>

			<button id="btn_right" class="Qbtn">Right</button>
			<button id="btn_wrong" class="Qbtn">Wrong</button>
					
			<h1 id="Answer" style="display:none">Answer not loaded</h1>

			<button id="continue" class="Qbtn" style="display:none">Continue</button>

		</div>


		<!--Script -->

		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/FileSaver.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
	</body>	
</html>