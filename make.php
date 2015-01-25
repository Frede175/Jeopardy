<!DOCTYPE html>
<html>
	<head>

		
		<link rel="stylesheet" href="css/main.css"/>
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<LINK REL="SHORTCUT ICON" HREF="images/logo.png">

	</head>

	<body>

		<div id="popup">
			<img src="images/close.png" id="close">

			<div id="make-game-popup">
				<h1>Welcome to the jeopardy maker!</h1>
				<h3 class="center">In The jeopardy maker you can make your jeopardy in custom sizes!</h3>
				<div id="select-newgame">
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
				</div>
				<button id="submit-makenewgame" class="center">Start makeing a new game!</button>
				
				<h4 class="center">You can change the number of subjects and questions later!</h4>
			</div>
		</div>

		<div id="dimmer"></div>
			
		<div>
			<img src="images/menu.png" id="menu">

			<div id="div-menu">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="make.php">Make</a></li>
					<li><a href="Jeopardy.php">Play</a></li>
					<li><a href="About.php">About</a></li>
				</ul>
				<ul id="ul-border">	
					<li><a href="#" id="save-game">Save game</a></li>
				</ul>

			</div>
		</div>

		


		<!--Script -->

		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/FileSaver.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>
		<script type="text/javascript" src="js/make.js"></script>
	</body>


</html>