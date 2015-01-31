var nQuestions = 0;
var nSubjects = 0;
var browser_width = 0;
var browser_height = 0;
var btn_state = new Array();
var subject_state = new Array();
var subjects_array = new Array();
var title = "Title";
var title_state;
var questions_array = new Array();
var activeId_btn;
var activeId_st = [];

$(document).ready(function() {
	generate_lists();
	showPopup(3);
	clickbtn();
});

function clickbtn() {
	clickmenu();
	
	$('#submit-makenewgame').click(function(event) {
		$('#add-remove-subject').attr('style', 'display: block');
		$('#add-remove-question').attr('style', 'display: block');
		$('#title').attr('style', 'display: block');
		$("#div-menu").hide("slow");
		closePopup();
		generatetable();
	});

	$('.btnQ').unbind().click(function(event) {
		//The question for that button!!!-------------------
		activeId_btn = this.id;
		console.log(activeId_btn);
		display_question();
		$(this).addClass('btn_pressed');
		showPopup(4);

	});

	$('.table_box_subject').unbind().click(function(event) {
		activeId_st[0] = $(this);
		activeId_st[1] = this.id;
		$('#input-edit').val(activeId_st[0].text());
		$('#h1-edit-text').text('Edit text for: ' + activeId_st[0].text());
		$(this).addClass('subject_pressed');
		showPopup(5);
		
	});

	$('#title').unbind().click(function(event) {
		activeId_st[0] = $(this);
		activeId_st[1] = this.id;
		$('#input-edit').val(activeId_st[0].text());
		$('#h1-edit-text').text('Edit the title!');
		$(this).addClass('subject_pressed');
		showPopup(5);
		
	});

	$('#submit-updateedit').click(function(event) {
			activeId_st[0].text($('#input-edit').val());
			if(activeId_st[1] === "title"){
				title = $('#input-edit').val();
			}
			else
			{
				var id_split = activeId_st[1].split("_");
				var id = parseInt(id_split[1])-1;
				subjects_array[id] = $('#input-edit').val();
			}
			closePopup();
		});

	$('#add-subject').unbind().click(function(event) {
		if(nSubjects < 8){
			update_state();
			nSubjects++;
			update_array(1);
			update();
			load_state();
		}else{
			alert("You can't create more than 8 subjects!");
		}
	});

	$('#remove-subject').unbind().click(function(event) {
		if(nSubjects > 2){
			update_state()
			nSubjects--;
			update_array(2);
			update();
			load_state();
		}else{
			alert("You can't have less than 2 subjects!");
		}
	});

	$('#add-question').unbind().click(function(event) {
		if(nQuestions < 10){
			update_state();
			nQuestions++;
			update_array(3);
			update();
			load_state();
		}else{
			alert("You can't have more than 10 questions!");
		}
	});

	$('#remove-question').unbind().click(function(event) {
		if(nQuestions > 2){
			update_state();
			nQuestions--;
			update_array(4);
			update();
			load_state();
		}else{
			alert("You can't have less than 2 questions!");
		}
	});

	$('#submit-updatebutton').unbind().click(function(event) {
		update_questions_array_button();
		closePopup();
	});

	//Menu save: 
	$('#save-game').unbind().click(function(event) {
		$("#div-menu").hide("slow");
		save(2);
	});

}

function generatetable() {

	browser_height = window.innerHeight-70;
	browser_width = window.innerWidth-70;

	nQuestions = parseInt($('#questions-number').val());
	nSubjects = parseInt($('#subjects-number').val());

	create_array();

	$('#make-table').height(browser_height);
	$('#make-table').width(browser_width);
	$('#bottom-bar').width(browser_width);
	$('#side-bar').height(browser_height);

	table(browser_width, browser_height+60, nQuestions, nSubjects);

	clickbtn();
}

function update() {

	$('#main_table').text('');
	table(browser_width, browser_height+60, nQuestions, nSubjects);

	clickbtn();

}

function create_array() {
	subjects_array = new Array(nSubjects);
	for(var i = 0; i < nSubjects; i++){
		questions_array[i] = new Array(nQuestions);
		for(var x = 0; x < nQuestions; x++){
			questions_array[i][x] = ":What is";
		}

		subjects_array[i] = "Subject " + (i+1);
		
	}
	
}

function display_question() {
	var idSplit = activeId_btn.split("_");
	var questions_array_split = questions_array[idSplit[1]-1][idSplit[2]-1].split(":");

	$('#input-question').val(questions_array_split[0]);
	$('#input-answer').val(questions_array_split[1]);
}

function update_array(input) {
	switch(input){
		case 1:

			//Questions Array:
			var number = questions_array.length;
			questions_array[number] = new Array(nQuestions);
			for(var i = 0; i < nQuestions; i++){
				questions_array[number][i] = ":What is";
			}

			//Subjects Array:
			number = subjects_array.length;
			subjects_array[number] = "Subject " + (number+1); 

			break;
		case 2:
			questions_array.splice(questions_array.length-1, 1);
			subjects_array.splice(subjects_array.length-1, 1);
			break;
		case 3:
			for(var i = 0; i < nSubjects; i++){
				var number = questions_array[i].length;
				questions_array[i][number] = ":What is";
			}
			break;
		case 4:
			for(var i = 0; i < nSubjects; i++){
				questions_array[i].splice(questions_array[i].length-1, 1);
			}
			break;
	}
}

function update_questions_array_button() {
	var idSplit = activeId_btn.split("_");
	questions_array[idSplit[1]-1][idSplit[2]-1] = $('#input-question').val() + ":" + $('#input-answer').val();
}

function update_state() {
	btn_state.length = 0;
	btn_state = new Array(nSubjects);
	for(var i = 0; i < nSubjects; i++){
		btn_state[i] = new Array(nQuestions);
		for(var x = 0; x < nQuestions; x++){
			var id = (i+1) + "_" + (x+1);
			btn_state[i][x] = $('#btn_' + id).hasClass('btn_pressed');
		}
	}

	subject_state.length = 0;
	subject_state = new Array(nSubjects);
	for(var i = 0; i < nSubjects; i++){
		subject_state[i] = $('#subject_' + (i+1)).hasClass('subject_pressed');
	}

	title = $('#title').hasClass('subject_pressed');
}

function load_state() {
	for(var i = 0; i < nSubjects; i++){
		$('#subject_' + (i+1)).text(subjects_array[i]);

		if(typeof subject_state[i] !== "null" && typeof subject_state[i] !== 'undefined'){
			if(subject_state[i] === true){
				$('#subject_' + (i+1)).addClass('subject_pressed');
			}
		}

		if(typeof btn_state[i] !== "null" && typeof btn_state[i] !== 'undefined' ){
			for(var x = 0; x < nQuestions; x++){
			var id = (i+1) + "_" + (x+1);
				if(typeof btn_state[i][x] !== "null" && typeof btn_state[i][x] !== "undefined"){
					if(btn_state[i][x] === true){
						$('#btn_' + id).addClass('btn_pressed');
					}
				}
			}
		}
	}

	if(title === true){
		$('#title').addClass('subject_pressed');
	}
}