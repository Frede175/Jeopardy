function showPopup(which) {
	$('#popup').show();
	$('#dimmer').show();
	$('#dimmer').unbind().click(function(event){
		closePopup();
	});

	if (which == 1){
		//New game
		$('#new-game-popup').show();
	}
	if (which == 2){
		//load game
		$('#load-game-popup').show();
	}
	if (which == 3) {
		$('#make-game-popup').show();
	}
}

function closePopup() {
	$('#popup').hide();
	$('#dimmer').hide();
	$('#new-game-popup').hide();
	$('#load-game-popup').hide();
}

function generate_lists() {
	for(var i = 2; i <11; i++){
		var $lists = $('.select_lists-' + i);

		for(var x = 2; x <= i; x++){
			$('.select_lists-' + i).append("<option value='" + x + "'>" + x + "</option>");
		}
	}
}

function save(){

	btn_id_save = [];

		$('.btnQ').each(function() {
			btn_id_save.push(this.id + ":" + this.disabled);
		});

	//Make file with data:
	var saveData = "SaveFile. DO NOT CHANGE ANYTING IN THIS FILE;"
	var separator = ";"

	//Adds how many teams there is
	saveData += teamnumber + separator
	+ Width + separator
	+ Height + separator
	+ countdown + separator
	+ activeTeam + separator;


	for(var i = 0; i < teamnumber; i++){
		var id = i+1;
		saveData += $('#TEAM_' + id).text()
		+ ":"
		+ TEAMPOINT[i] 
		+ separator;
	}

	//Subjects saved here
	for(var i = 0; i < Width; i++){
		var id = i+1;
		saveData += $('#subject_' + id).text() + separator;
	}

	for(var i = 0; i < btn_id_save.length; i++){
		saveData += btn_id_save[i] + separator;
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



	// For debug only --------------------------------------------------
	for(var i = 0; i < btn_id_save.length; i++){
		console.log(btn_id_save[i]);
	}

	for(var i = 0; i < btn_id_save.length; i++){
		var split = btn_id_save[i].split(":");
		for(var x = 0; x < split.length; x++){
			console.log(split[x]);
		}
	}
}

function loadState(fileData){

	//Clear tables
	$('#TEAMS_tr').text('');
	$('#main_table').text('');

	var fileData_split = fileData.split(";");
	$('#newGame').remove();

	var readNumber = 6;

	teamnumber = parseInt(fileData_split[1]);
	Width = parseInt(fileData_split[2]);
	Height = parseInt(fileData_split[3]);
	countdown = parseInt(fileData_split[4]);
	activeTeam = parseInt(fileData_split[5])

	makeScorer(); table(); Questions(); //Generate the table

	//Teams name and points
	for(var i = 0; i < teamnumber; i++){
		var fileData_split_split = fileData_split[readNumber].split(":");
		var id = i+1;
		$('#TEAM_' + id).text(fileData_split_split[0]);
		TEAMPOINT[i] = parseInt(fileData_split_split[1]);
		$('#TEAMSPOINT_' + id).text(fileData_split_split[1]);
		readNumber++;
	}

	//Subjects name
	for(var i = 0; i < Width; i++){
		var id = i+1;
		$('#subject_' + id).text(fileData_split[readNumber]);
		readNumber++;
	}

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

	//Questions and answer
	for(var i = 0; i < Width; i++){
		for(var j = 0; j < Height; j++){
			questions_array[i][j] = fileData_split[readNumber];
			readNumber++;
		}
	}
}

function clickmenu() {
	$('#save-game').unbind().click(function(event) {
		$("#div-menu").hide("slow");
		save();
	});
	$('#new-game').unbind().click(function(event) {
		$("#div-menu").hide("slow");
		$('#TEAMS_tr').text('');
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
		activeTeam = 0;
		countdown = 60; //måske
		teamnumber = parseInt($('#teams-number').val());
		Width = parseInt($('#subjects-number').val()); //Width
		Height = parseInt($('#questions-number').val()); //Height
		closePopup();

		console.log(teamnumber + " " + Width + " " + Height); 

		makeScorer(); table(); Questions(); //Generate the table
		clickbtn();
	});

	$('#load-game').unbind().click(function(event) {
		showPopup(2);
	});

	$('#close').unbind().click(function(event) {
		closePopup();
	});

	$('#menu').unbind().click(function(event) {
		$("#div-menu").toggle("slow");
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
				loadState(reader.result);
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