<!DOCTYPE html>
<html>
	<head>
		<title>Jeopardy</title>


		<link rel="stylesheet" href="css/main.css"/>
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<LINK REL="SHORTCUT ICON" HREF="images/logo.png">
	</head>

	<body>

		<div id="popup">
			<img src="images/close.png" id="close">

		</div>

		<div id="dimmer">

		</div>
			
		<div>
			<img src="images/menu.png" id="menu">

			<div id="div-menu">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="make.html">Make</a></li>
					<li><a href="Jeopardy.php">Play</a></li>
					<li><a href="About.php">About</a></li>
				</ul>
				<ul id="ul-border">	
					<li><a href="#" id="new-game">New game</a></li>
					<li><a href="#" id="save-game">Save game</a></li>
					<li><a href="#" id="load-game">Load game</a></li>
				</ul>

			</div>
		</div>

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
<!--
			<button id="newGame">New Game</button>
			<button id="saveState">Save</button>
			<br>
			Load saved game:
			<input type="file" id="loadState">
-->
		</div>

		<div id="Questions" style="display:none" class="center">

			<p class="Timer">Time left: <p id="timer_countdown" class="Timer">0</p></p>

			<h1 id="Question">Question not loaded</h1>

			<button id="btn_right" class="Qbtn">Right</button>
			<button id="btn_wrong" class="Qbtn">Wrong</button>
					
			<h1 id="Answer" style="display:none">Answer not loaded</h1>

			<button id="continue" class="Qbtn" style="display:none">Continue</button>

		</div>


		<!-- Footer ........................ --> 
		<div id="background-madeby">
			<p>Background is by <a href="http://www.squidfingers.com/patterns" target="_blank">Squidfingers</a></p>
		</div>

		<!--Script -->

		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/FileSaver.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
	</body>	
</html>