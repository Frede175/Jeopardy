<!DOCTYPE html>
<html>
	<head>

		
		<link rel="stylesheet" href="css/main.css"/>
		<link rel="stylesheet" href="css/menu-animation.css"/>
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="css/jquery-ui.css"/>
		<LINK REL="SHORTCUT ICON" HREF="images/logo.png">

	</head>
	
	<body>

		<div id="popup">
			<img src="images/close.png" id="close">

			<div id="make-game-popup" class="popup">
				<h1>Welcome to the jeopardy maker!</h1>
				<h3 class="center">In The jeopardy maker you can make your jeopardy in custom sizes!</h3>
				<div class="select-newgame">
					<table>
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
				
				<h4 class="center">You can change the number of teams, subjects and questions later!</h4>
			</div>

			<div id="edit-buttons-popup" class="popup"> 
				<div class="center">

					<h1 id="button-text">Edit button for</h1>
					<form>
						<h3>Question:</h3>
						<textarea type="text" id="input-question"></textarea>
						<br>
						<br>
						<h3>Anwser:</h3>
						<textarea type="text" id="input-answer" ></textarea>
					</form>
				</div>
				<button id="submit-updatebutton" class="center">Update</button>
			</div>

			<div id="edit-text-popup" class="popup">
				<div class="center">
					<h1 id="h1-edit-text">Edit</h1>
					<input type="text" class="input-edit" id="input-edit-id">
				</div>
				<button id="submit-updateedit" class="center">Update</button>
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
					<li><a href="#" id="save-game">Save game</a></li>
				</ul>

			</div>
		</div>
		
		
		<!-- Table to append to with javascript! -->
		<p id="title" style="display: none" class="noselect">Title</p>
		<div id="make-table">
			<table class="fixed">
				<tbody id="main_table">

				</tbody>

			</table>
			
		</div>
		

		<div id="right-bar">
			<div id="add-remove-subject">
				<img src="images/add.png" id="add-subject" />
				<img src="images/remove.png" id="remove-subject" />
			</div>
		</div>


		

		<div id="background-madeby">
			<p>Background is by <a href="http://www.squidfingers.com/patterns" target="_blank">Squidfingers</a></p>
		</div>

		<div id="bottom-bar">
			<div id="add-remove-question">
				<img src="images/add.png" id="add-question" />
				<img src="images/remove.png" id="remove-question" />
			</div>
		</div>
		<!--Script -->

		<script type="text/javascript" src="js/jquery-latest.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/FileSaver.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>
		<script type="text/javascript" src="js/make.js"></script>
	</body>


</html>