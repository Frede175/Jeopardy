var nQuestions = 0;
var nSubjects = 0;
var browser_width = 0;
var browser_height = 0;
var btn_state = new Array();
var questions_array = new Array();
var activeId;

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
		$("#div-menu").hide("slow");
		closePopup();
		generatetable();
	});

	$('.btnQ').unbind().click(function(event) {
		//The question for that button!!!-------------------
		activeId = this.id;
		console.log(activeId);
		display_question();
		$(this).addClass('btn_pressed');
		showPopup(4);

	});

	$('#add-subject').unbind().click(function(event) {
		if(nSubjects < 8){
			update_btn_state();
			nSubjects++;
			update_questions_array(1);
			update();
			load_btn_state();
		}else{
			alert("You can't create more than 8 subjects!");
		}
	});

	$('#remove-subject').unbind().click(function(event) {
		if(nSubjects > 2){
			update_btn_state()
			nSubjects--;
			update_questions_array(2);
			update();
			load_btn_state();
		}else{
			alert("You can't have less than 2 subjects!");
		}
	});

	$('#add-question').unbind().click(function(event) {
		if(nQuestions < 10){
			update_btn_state();
			nQuestions++;
			update_questions_array(3);
			update();
			load_btn_state();
		}else{
			alert("You can't have more than 10 questions!");
		}
	});

	$('#remove-question').unbind().click(function(event) {
		if(nQuestions > 2){
			update_btn_state();
			nQuestions--;
			update_questions_array(4);
			update();
			load_btn_state();
		}else{
			alert("You can't have less than 2 questions!");
		}
	});

	$('#submit-updatebutton').unbind().click(function(event) {
		update_questions_array_button();
		closePopup();
	});

}

function generatetable() {

	browser_height = window.innerHeight-70;
	browser_width = window.innerWidth-70;

	nQuestions = parseInt($('#questions-number').val());
	nSubjects = parseInt($('#subjects-number').val());

	questions();

	$('#make-table').height(browser_height);
	$('#make-table').width(browser_width);
	$('#bottom-bar').width(browser_width);
	$('#side-bar').height(browser_height);

	table(browser_width, browser_height+120, nQuestions, nSubjects);

	clickbtn();
}

function update() {

	$('#main_table').text('');
	table(browser_width, browser_height+120, nQuestions, nSubjects);

	clickbtn();

}

function questions() {
	for(var i = 0; i < nSubjects; i++){
		questions_array[i] = new Array(nQuestions);
		for(var x = 0; x < nQuestions; x++){
			questions_array[i][x] = ":What is";
		}
	}
}

function display_question() {
	var idSplit = activeId.split("_");
	var questions_array_split = questions_array[idSplit[1]-1][idSplit[2]-1].split(":");

	$('#input-question').val(questions_array_split[0]);
	$('#input-answer').val(questions_array_split[1]);
}

function update_questions_array(input) {
	switch(input){
		case 1:
			var number = questions_array.length;
			questions_array[questions_array.length] = new Array(nQuestions);
			for(var i = 0; i < nQuestions; i++){
				questions_array[number][i] = ":What is";
			}
			break;
		case 2:
			questions_array.splice(questions_array.length-1, 1);
			break;
		case 3:
			for(var i = 0; i < nSubjects; i++){
				questions_array[i][questions_array[i].length] = ":What is";
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
	var idSplit = activeId.split("_");
	questions_array[idSplit[1]-1][idSplit[2]-1] = $('#input-question').val() + ":" + $('#input-answer').val();
}

function update_btn_state() {
	btn_state.length = 0;
	btn_state = new Array(nSubjects);
	for(var i = 0; i < nSubjects; i++){
		btn_state[i] = new Array(nQuestions);
		for(var x = 0; x < nQuestions; x++){
			var id = (i+1) + "_" + (x+1);
			btn_state[i][x] = $('#btn_' + id).hasClass('btn_pressed');
		}
	}

	console.log(btn_state);
}

function load_btn_state() {
	for(var i = 0; i < nSubjects; i++){
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
}