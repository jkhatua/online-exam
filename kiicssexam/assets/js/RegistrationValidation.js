
$(document).ready(function() {
	$("#RegistrationForm").submit( function() {

		var name = $("input[name=name]");
		var email = $("input[name=email]");
		var contact = $("input[name=contact]");
		var gender = $("input[name=gender]");
		var blood_group = $("input[name=blood_group]");
		var dob = $("input[name=dob]");
		var address = $("input[name=address]");
		var university = $("input[name=university]");
		var college = $("input[name=college]");
		var cgpa = $("input[name=cgpa]");
		var passout = $("input[name=passout]");

		var letters = /^[A-Za-z]*$/;	//Letters RegEx
		var numbers = /^[0-9]*$/;	//Numbers RegEx
		var aplphanum = /^[A-Za-z0-9]*$/;	//Alphanum RegEx
		var fullname = /^[A-Za-z0-9]+[A-Za-z0-9\s]*$/;	//Full Name RegEx

		var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;	//Email RegEx

		if ((name.val() == "") || (name.val() == false)) {
			swal("Invalid Name", "Please Enter a valid Name","error");
			name.focus();
			return false;
		}
		else if (!name.val().match(fullname)) {
			swal("Invalid Name", "Please Enter a valid Name","error");
			name.focus();
			return false;
		}
		else if ((email.val() == "") || (email.val() == false)) {
			swal("Invalid Email", "Please Enter a valid Email","error");
			email.focus();
			return false;	
		}
		else if (!email.val().match(email_regex)) {
			swal("Invalid Email", "Please Enter a valid Email","error");
			email.focus();
			return false;		
		}
		// else if () {
		// 	swal("Invalid Contact", "Please Enter a valid Contact number","error");
		// 	contact.focus();
		// 	return false;
		// }
		// else if (true) {
		// 	swal("Invalid Gender", "Please Enter a valid Gender","error");
		// 	gender.focus();
		// 	return false;
		// }
		// else if (true) {
		// 	swal("Invalid Blood Group", "Please Enter a valid Blood group","error");
		// 	blood_group.focus();
		// 	return false;
		// }
		// else if (true) {
		// 	swal("Invalid DOB", "Please Enter a valid Date of Birth","error");
		// 	dob.focus();
		// 	return false;
		// }
		// else if (true) {
		// 	swal("Invalid Address", "Please Enter a valid Address","error");
		// 	address.focus();
		// 	return false;
		// }
		// else if (true) {
		// 	swal("Invalid University", "Please Enter a valid University name","error");
		// 	university.focus();
		// 	return false;
		// }
		// else if (true) {
		// 	swal("Invalid Collge", "Please Enter a valid Collge name","error");
		// 	college.focus();
		// 	return false;
		// }
		// else if (true) {
		// 	swal("Invalid CGPA", "Please Enter a valid CGPA","error");
		// 	cgpa.focus();
		// 	return false;
		// }
		// else if (true) {
		// 	swal("Invalid Passout year", "Please Enter a valid Passout year","error");
		// 	passout.focus();
		// 	return false;
		// }

		else {
			swal("Success", "Please Enter a valid Name","success");
			name.focus();
			return false;
		}
	})
});