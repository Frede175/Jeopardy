	var TEAMPOINT = [];
	var activeTeam = 0;
	var teamnumber = 0;
	var countdown = 0;
	var Width = 0;
	var Height = 0;
	var btn_id_save = []; // Test only
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

}

function table() {

	//HEADER --------------------------------------------------------------------------------------------------------------------

	var w = window.innerWidth;
	var h = window.innerHeight;


	console.log("Height: "+ h, "Width: " + w);

	var htable = setHeight(h, Height);
	var wtable = setWidth(w, Width);

	console.log(htable, wtable);

	var trhead = document.createElement('tr');

	for (var i = 1; i <= Width; i ++){
		var td = document.createElement('td');
		var node = document.createTextNode("Subject " + i);
		td.appendChild(node); 
		td.setAttribute("height", htable); td.setAttribute("width", wtable); td.setAttribute("class", "table_box_subject"); td.setAttribute("id", "subject_" + i)
		trhead.appendChild(td);
	}

	document.getElementById('main_table').appendChild(trhead);




	//MAIN TABLE -----------------------------------------------------------------------------------------------------------------

	for (var j = 1; j <= Height; j++){


		var tr = document.createElement('tr');


		for (var i = 1; i <= Width; i++){

			var tdata = document.createElement('td');
			tdata.setAttribute("class", "table_box"); tdata.setAttribute("height", htable); tdata.setAttribute("width", wtable);

				var btn = document.createElement('button');
				var node1 = document.createTextNode(j*100); 
				btn.setAttribute("type", "button"); btn.setAttribute("class", "btnQ btnQ_enable"); btn.setAttribute("id", "btn_"+i+"_"+j);

				btn.appendChild(node1);

			tdata.appendChild(btn);
			tr.appendChild(tdata);

		}

		document.getElementById('main_table').appendChild(tr);
	}

}

function makeScorer() {

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

function setHeight(winH, y) {
	console.log("setHeight: " + y);
	console.log("setHeight: " + (winH-150));
	return (winH-150)/(y+1);
}

function setWidth(winW, x) {
	return (winW-150)/x;
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