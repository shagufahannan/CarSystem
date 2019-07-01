

function loginValidation(){
	
	var flag = true;
	if(document.getElementById('username').value.length == 0){
		alert("Please Enter Username");
		flag = false;
	}
	if(document.getElementById('password').value.length == 0){
		alert("Please Enter Password");
		flag = false;
	}
	return flag;
}
