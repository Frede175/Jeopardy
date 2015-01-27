var nQuestions = 0;
var nSubjects = 0;
var browser_width = 0;
var browser_height = 0;

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

		showPopup(4);
	});

	$('#add-subject').unbind().click(function(event) {
		nSubjects++;
		update();
	});

	$('#remove-subject').unbind().click(function(event) {
		nSubjects--;
		update();
	});

	$('#add-question').unbind().click(function(event) {
		nQuestions++;
		update();
	});

	$('#remove-question').unbind().click(function(event) {
		nQuestions--;
		update();
	});

}

function generatetable() {


	browser_height = window.innerHeight-70;
	browser_width = window.innerWidth-70;

	nQuestions = parseInt($('#questions-number').val());
	nSubjects = parseInt($('#subjects-number').val());

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


