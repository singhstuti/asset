function validatePassword(){
	var password = document.getElementById("password");
	var confirmPassword = document.getElementById("confirm_password");
	var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[#?!@$%^&*-])[0-9a-zA-Z#?!@$%^&*-]{8,15}$/;
	var div = document.getElementById("password_message");
	if(password.value.match(pattern)){
		div.innerHTML ="";
		div.style.display = "none";
		return true;
	}else{
		password.value="";
		confirmPassword.value="";
		div.style.color = "red";
		div.style.display = "block";
		div.innerHTML = "Password must contain 8 to 15 characters which contains at least one numeric digit,one uppercase,one lowercase letter and one special character";
		return false;
	}
}

function checkPassword(){
	var password = document.getElementById("password");
	var confirmPassword = document.getElementById("confirm_password");
	var div = document.getElementById("confirm_password_message");
	
	if(password.value == confirm_password.value){
		return true;
	}else{
		div.style.color = "red";
		div.style.display = "block";
		div.innerHTML = "Passwords don't match. Please try again!";
		password.value="";
		confirmPassword.value="";
		return false;
	}
}

 
function validateForm(){
	var status;

	var x = validatePassword();
	if(x==true){
		var x1 = checkPassword();
		if(x1==true){
			status = true;
		}else{
			status = false;
		}
	}else{
		status = false;
	}			
	
	return status;
}