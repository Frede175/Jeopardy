var nQuestions = 0;
var nSubjects = 0;

$(document).ready(function() {
	generate_lists();
	showPopup(3);
	clickbtn();
})

function clickbtn() {
	clickmenu();
	
	$('#submit-makenewgame').click(function(event) {
		generatetable();
	});
}

function generatetable() {
	nQuestions = parseInt($('#questions-number').val());
	nSubjects = parseInt($('#subjects-number').val());

	
}

