function formhash(form, password) {
	var p = document.createElement('input');

	form.appendChild(p);
	p.name = "p";
	p.type = "hidden";
	p.value = hex_sha512(password.value);

	password.value = "";
	form.submit();
}

function regformhash(form, uid, email, password, conf) {
	if (uid.value == '' || email.value == '' || password.value == '' || conf.value == '') {
		alert('You must enter in all the deteils! Please try again');
		return false;
	}

	var re = /^\w+$/;
	if(!re.test(form.username.value)) {
		alert("Username must contain only letters, numbers and underscores. Please try again"); 
		form.username.focus();
		return false;
	}

	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(!re.test(email.value)) {
		alert('Emails must contain @ and be a valid email');
		return false;
	}


	if(password.value.length < 6){
		alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
	}

	re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
	if(!re.test(password.value)) {
		alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
	}

	if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }

    var p = document.createElement("input");
  
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    password.value = "";
    conf.value = "";

    form.submit();
    return true;
}