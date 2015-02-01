	var TEAMPOINT = [];
	var activeTeam = 0;
	var teamnumber = 0;
	var countdown = 0;
	var Width = 0;
	var Height = 0;
	var questions_array = new Array(Width);
	var Questions_moveon = 0;

$(document).ready(function() {
	generate_lists();
	var point = 0;
	clickbtn();

});

function clickbtn() {
	clickmenu();
	// ----------------------------------- Button for  Q
	$('.btnQ').unbind().click(function() {

		$(this).attr("disabled", "disabled");
		$(this).removeClass('btnQ_enable');
		// $(this).text('');
		
		display_questions(this.id);

		point = calc_points(this.id);


	});

	$('#btn_right').unbind().click(function(event) {
		points();

		point = null;

		//display_maintable();
		showAnswer();
		ClearTimer();
	});

	$('#btn_wrong').unbind().click(function(event) {
		if(Questions_moveon == 0){
		points("wrong");
		changeTeam();
		}
		//display_maintable();
		showAnswer();
		ClearTimer();
	});

	$('#continue').unbind().click(function(event) {
		hideAnswer();
		display_maintable();
	});

	//Menu save:
	$('#save-game').unbind().click(function(event) {
		$("#div-menu").hide("slow");
		save(1, Width, Height, questions_array, teamnumber, activeTeam, TEAMPOINT);
	});

}

function makeScorer() {

	TEAMPOINT.length = 0;
	console.log(TEAMPOINT);

	var w = window.innerWidth;

	var wTeam = w/teamnumber;

	//Points for the teams...
	var Points = 0;
	
	$('#title').attr("style", "");

	for(var i = 1; i <= teamnumber; i++){

		var td = document.createElement('td');
		td.setAttribute("id", "TEAM_td_"+ i); td.setAttribute("class", "TD_TEAMPOINT"); td.setAttribute("width", wTeam);

		var p = document.createElement('p');
		var p1 = document.createElement('p');
		var p2 = document.createElement('p');

		p.setAttribute("class", "TEAMS"); p.setAttribute("id", "TEAM_" + i);
		var node = document.createTextNode("Team " + i);
		p.appendChild(node);

		p1.setAttribute("class", "TEAMS");
		var node = document.createTextNode(": ");
		p1.appendChild(node);

		p2.setAttribute("class", "TEAMS"); p2.setAttribute("id", "TEAMSPOINT_" + i)
		var node = document.createTextNode(Points);
		p2.appendChild(node);

		td.appendChild(p);
		td.appendChild(p1);
		td.appendChild(p2);

		document.getElementById('TEAMS_tr').appendChild(td);

		//Adds a new team!! --------------------- Adds a new team!!
		TEAMPOINT[TEAMPOINT.length] = Points;

		
	}

	//$('TEAM_id_1').addClass('current');

	console.log("Number of teams: " + TEAMPOINT.length);

	var id = activeTeam+1;
	$('#TEAM_td_' + id).addClass("current");
}

function Questions() {
	for(var i = 0; i < Width; i++){
		questions_array[i] = new Array(Height);
		for (var x = 0; x < Height; x++) {
			questions_array[i][x] = "Questions for button " + (i+1) + " " + (x+1) + ":" + "Answer for button " + (i+1) + " " + (x+1)
		};
	}
}

function changeTeam(){
	console.log("activeTeam: " + activeTeam);
	if (activeTeam < teamnumber-1){
		activeTeam += 1;
	}
	else
	{
		activeTeam = 0;
	}
	console.log("Active Team is: " + activeTeam);

	$('.TD_TEAMPOINT').removeClass('current');
	var id = activeTeam + 1
	$('#TEAM_td_' + id).addClass("current");
}

//need disable for btn_right and wrong
function showAnswer(){
	document.getElementById('Answer').setAttribute("style", "display:");
	document.getElementById('continue').setAttribute("style", "display:");
	document.getElementById('btn_right').disabled = true;
	document.getElementById('btn_wrong').disabled = true;
}

function hideAnswer(){
	document.getElementById('Answer').setAttribute("style", "display:none");
	document.getElementById('continue').setAttribute("style", "display:none");
	document.getElementById('btn_right').disabled = false;
	document.getElementById('btn_wrong').disabled = false;
}



function calc_points(btn_id){
	var btnsplit = btn_id.split("_");

	//Debug only
		console.log("Debug - console");
		for(var h = 0; h < btnsplit.length; h++){console.log(btnsplit[h])}
		console.log(btn_id); 
		//Debug end

	return btnsplit[2]*100; 
}

function display_questions(btn_id){

	//loading Questions
	var btn_id_split = btn_id.split("_"); var btn_Width = btn_id_split[1]-1; var btn_Height = btn_id_split[2]-1;

	var questions_array_split = questions_array[btn_Width][btn_Height].split(":");

	console.log(questions_array_split[0]);
	console.log(questions_array_split[1]);

	document.getElementById('Question').innerHTML = questions_array_split[0];
	document.getElementById('Answer').innerHTML = questions_array_split[1];

	//Loading timer
	QuestionsTimer();

	//Displaying Questions table
	document.getElementById('main_table').setAttribute("style", "display:none");
	document.getElementById('Questions').setAttribute("style", "display:");
}

function display_maintable(){
	document.getElementById('main_table').setAttribute("style", "display:");
	document.getElementById('Questions').setAttribute("style", "display:none");
	var timer_countdown = document.getElementById('timer_countdown');
	timer_countdown.innerHTML = countdown;
	Questions_moveon = 0;
}

function QuestionsTimer(){
	var countdown_timer = countdown;

	if (Questions_moveon > 0){
		console.log("TRUE");
		countdown_timer = countdown_timer/2;
	}

	var timer_countdown = document.getElementById('timer_countdown');

	timer_countdown.innerHTML = countdown_timer;

	Timer = setInterval(function () {
		if(countdown_timer <= 0){
			ClearTimer();
			if(Questions_moveon < 1){
				points("wrong");
				alert("The time ran out. Moving on to the next team");
				changeTeam();
				Questions_moveon++;
				QuestionsTimer();
			}else{
				alert("The time ran out. Going to show the answer to the question now!");
				showAnswer();
			}
		}
		else
		{
		countdown_timer--;

		timer_countdown.innerHTML = countdown_timer;
		}
	}, 1000);

}


function ClearTimer(){
	clearInterval(Timer);
	var timer_countdown = document.getElementById('timer_countdown');
}

function points(state) {
	if(state == "wrong"){
			TEAMPOINT[activeTeam] -= point;
		}else{
			if(Questions_moveon == 1){
				TEAMPOINT[activeTeam] += point/2;
			}else{
				TEAMPOINT[activeTeam] += point;
			}
		}

		var teamid = 'TEAMSPOINT_' + (activeTeam+1); //Teamspoint text field id for points
		document.getElementById(teamid).innerHTML = TEAMPOINT[activeTeam];
	
}

function loadState(fileData, team){

	//Clear tables
	$('#TEAMS_tr').text('');
	$('#main_table').text('');

	var fileData_split = fileData.split(";");
	$('#newGame').remove();
	
	$('#title').text(fileData_split[0]);
	teamnumber = parseInt(fileData_split[1]);
	Width = parseInt(fileData_split[2]);
	Height = parseInt(fileData_split[3]);
	if(teamnumber > 0){
		countdown = parseInt(fileData_split[4]);
		activeTeam = parseInt(fileData_split[5])
		var readNumber = 6;
	}
	else{
		var readNumber = 4;
		teamnumber = team;
		countdown = 60;
	}

	var h = window.innerHeight;
	var w = window.innerWidth;

	makeScorer(); table(w, h, Width, Height); Questions(); //Generate the table

	if(parseInt(fileData_split[1] == 0)){
		//Teams name and points
		for(var i = 0; i < teamnumber; i++){
			var fileData_split_split = fileData_split[readNumber].split(":");
			var id = i+1;
			$('#TEAM_' + id).text(fileData_split_split[0]);
			TEAMPOINT[i] = parseInt(fileData_split_split[1]);
			$('#TEAMSPOINT_' + id).text(fileData_split_split[1]);
			readNumber++;
		}
	}

	//Subjects name
	for(var i = 0; i < Width; i++){
		var id = i+1;
		$('#subject_' + id).text(fileData_split[readNumber]);
		readNumber++;
	}

	if(parseInt(fileData_split[1] == 0)){
		//Button stats
		for(var i = 0; i < Width; i++){
			for(var j =0; j < Height; j++){
				var fileData_split_split = fileData_split[readNumber].split(":");
				console.log(fileData_split_split[0] + ", " + fileData_split_split[1]);
				var id = i + '_' + j;
				if(fileData_split_split[1] == "true"){
					document.getElementById(fileData_split_split[0]).disabled = true;
					$('#' + fileData_split_split[0]).removeClass('btnQ_enable');
				}
				else
				{
					document.getElementById(fileData_split_split[0]).disabled = false;
				}
				readNumber++;
			}
		}
	}

	//Questions and answer
	for(var i = 0; i < Width; i++){
		for(var j = 0; j < Height; j++){
			questions_array[i][j] = fileData_split[readNumber];
			readNumber++;
		}
	}

	clickbtn();
}