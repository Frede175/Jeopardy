var readerResult;
var team;

function showPopup(which) {
	$('#popup').fadeIn("slow");
	$('#dimmer').fadeIn("slow");
	$('#dimmer').unbind().click(function(event){
		closePopup();
	});
	
	switch(which){
		case 1:
			//New game
			$('#new-game-popup').fadeIn("slow");
			break;
		case 2:
			//load game
			$('#load-game-popup').fadeIn("slow");
			break;
		case 3:
			$('#make-game-popup').fadeIn("slow");
			break;
		case 4:
			$('#edit-buttons-popup').fadeIn("slow");
			break;
		case 5:
			$('#edit-text-popup').fadeIn("slow");
			break;
		case 6:
			$('#teams-popup').fadeIn("slow");
			break;
	}

}

function closePopup() {
	$('#popup').fadeOut("slow");
	$('#dimmer').fadeOut("slow");
	$('.popup').fadeOut("slow");
}

function generate_lists() {
	for(var i = 2; i <11; i++){
		var $lists = $('.select_lists-' + i);

		for(var x = 2; x <= i; x++){
			$('.select_lists-' + i).append("<option value='" + x + "'>" + x + "</option>");
		}
	}
}

function save(save_state, Width, Height, questions_array, teamnumber, activeTeam, TEAMPOINT){
	//Save_state is the number I'll use for checking of it is the make.js or app.js save!

	if(save_state == 1){
		var btn_id_save = [];

			$('.btnQ').each(function() {
				btn_id_save.push(this.id + ":" + this.disabled);
			});
	}
	//Make file with data:
	var saveData;
	var separator = ";"

	//title
	saveData = $('#title').text() + separator;
	 
	if(save_state == 1){
		saveData += teamnumber + separator;
	}
	else
	{
		saveData += 0 + separator;
	}
	saveData += Width + separator + Height + separator;

	if(save_state == 1){
		saveData += countdown + separator + activeTeam + separator;
		for(var i = 0; i < teamnumber; i++){
			var id = i+1;
			saveData += $('#TEAM_' + id).text()
			+ ":"
			+ TEAMPOINT[i] 
			+ separator;
		}
	}

	//Subjects saved here
	for(var i = 0; i < Width; i++){
		var id = i+1;
		saveData += $('#subject_' + id).text() + separator;
	}

	if(save_state == 1){
		for(var i = 0; i < btn_id_save.length; i++){
			saveData += btn_id_save[i] + separator;
		}
	}

	//Save Questions
	for (var i = 0; i < Width; i++) {
		for (var x = 0; x < Height; x++) {
			saveData += questions_array[i][x] + separator;
		};
	};

	var blobObject = new Blob([saveData]); 
	
	saveAs(blobObject, 'JeopardySaveFile.txt'); //JSave

	saveData = "SaveFile;";
}

function clickmenu() {
	
	$('#new-game').unbind().click(function(event) {
		$("#div-menu").hide("slow");
		$('#teams_tr').text('');
		$('#main_table').text('');
	/*	activeTeam = 0;
		teamnumber = 4;
		countdown = 60;
		Width = 4; //Width
		Height = 5; //Height 
	*/
		showPopup(1);

	}); 

	$('#submit-newgame').unbind().click(function(event) {
		TEAMPOINT.length = 0;
		activeTeam = 0;
		countdown = 60; //måske
		teamnumber = parseInt($('#teams-number').val());
		Width = parseInt($('#subjects-number').val()); //Width
		Height = parseInt($('#questions-number').val()); //Height
		closePopup();

		var h = window.innerHeight;
		var w = window.innerWidth;

		console.log(teamnumber + " " + Width + " " + Height); 

		makeScorer(); table(w, h, Width, Height); Questions(); //Generate the table
		clickbtn();
	});

	$('#submit-teams-continue').unbind().click(function(event) {
		team = parseInt($('#teams-number-team').val());
		$('#teams-popup-start').hide();
		for(var i = 0; i < team; i++){
			var input = document.createElement('input');
			input.setAttribute('type', 'text'); input.setAttribute('class', 'input-edit center'); input.setAttribute('id', 'team-input-' + i);
			$('#teams-name-append').append(input);
			$('#team-input-' + i).val("Team " + (i+1));
		}
		$('#teams-popup-end').show();
	});

	$('#submit-newgame-teams').unbind().click(function(event) {
		closePopup();
		var team_names = [];
		for(var i = 0; i < team; i++){
			team_names.push($('#team-input-' + i).val());
		}
		loadState(readerResult, team, team_names);
	});

	$('#load-game').unbind().click(function(event) {
		showPopup(2);
	});

	$('#close').unbind().click(function(event) {
		closePopup();
	});

	$('#menu').unbind().click(function(event) {
		$("#div-menu").toggle("slide", {direction: "right"});
	});

	window.onload = function() {
    var fileInput = document.getElementById('loadState');;

    fileInput.addEventListener('change', function(e) {
    	closePopup();
      	var file = fileInput.files[0];
		var textType = /text.*/;

		if (file.type.match(textType)){

			console.log("Filetype matched: " + file.type);
			var reader = new FileReader();

			reader.onload = function(e) {
				checkteams(reader.result)
				readerResult = reader.result;
				clickmenu();
				clickbtn();
			}

			reader.readAsText(file);
			console.log("Yeah it worked");
		}else{
			alert("Could not read the file...");
		}
    });
	} 
}

function table(w, h, Height, Width) {

	//HEADER --------------------------------------------------------------------------------------------------------------------

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

function setHeight(winH, y) {
	return (winH-150)/(y+1);
}

function setWidth(winW, x) {
	return (winW-150)/x;
}

function checkteams(data) {
	var data_split = data.split(";");
	if(data_split[1] > 0){
		return;
	}
	else
	{
		showPopup(6);
	}
}