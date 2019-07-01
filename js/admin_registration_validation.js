//alert("Hello World!");
var registrationValidation = 0;
var indicatorFlag = false;
var fName = false;
var lName = false;
var email = false;
var username = false;
var pass = false;
var repass = false;

function showFlag(){
	console.log("First name: "+fName);
	console.log("Last name: "+lName);
	console.log("email: "+email);
	console.log("username: "+username);
	console.log("pass: "+pass);
	console.log("repass: "+repass);
}

function isValid(){
	if(fName && lName && email && username && pass && repass)
		return true;
	return false;
}

// First name validation
function firstNameValidation(e){
	
	if(e.value.length < 1){
		document.getElementById('notice_icon_1').style.visibility = "hidden";
	}else{
		document.getElementById('notice_icon_1').style.visibility = "visible";
		if(e.value.length > 3){
			document.getElementById('notice_icon_1').src = "../../website_icon/tick_correct.png"; 
			fName = true;
			if(isValid()){
				document.getElementById("submitButton").disabled = false;
			}
		}else{
			fName = false;
			document.getElementById('notice_icon_1').src = "../../website_icon/cross.png";
			document.getElementById("submitButton").disabled = true;
		}
	}
	
	
	
	showFlag();
}

// Last name validation
function lastNameValidation(e){
	if(e.value.length < 1){
		document.getElementById('notice_icon_2').style.visibility = "hidden";
	}else{
		document.getElementById('notice_icon_2').style.visibility = "visible";
		if(e.value.length > 3){
			lName = true;
			document.getElementById('notice_icon_2').src = "../../website_icon/tick_correct.png";
			if(isValid()){
				document.getElementById("submitButton").disabled = false;
			}
		}else{
			lName = false;
			document.getElementById('notice_icon_2').src = "../../website_icon/cross.png";
			document.getElementById("submitButton").disabled = true;
		}
	}
	showFlag();
}

//find user name and email existance

//User name validation

function usernameValidation(e){
		
	if(e.value.length < 1){
		document.getElementById('notice_icon_3').style.visibility = "hidden";	
		document.getElementById('userMsg').innerHTML = "";
	}else{

		document.getElementById('notice_icon_3').style.visibility = "visible";
		
		var xmlHTTP = new XMLHttpRequest();	
		var usernameerrorMsg = document.getElementById('userMsg');
		usernameerrorMsg.innerHTML = '';
		//TODO AJAX for checking email
		xmlHTTP.onreadystatechange = function(){
			
			if(xmlHTTP.readyState == 4 && xmlHTTP.status == 200){
				//console.log(result);
				console.log( e.value+" "+e.value.length );
				if(xmlHTTP.responseText == 1 ){
					//console.log("Called IF");
					document.getElementById('notice_icon_3').src = "../../website_icon/cross.png";	
					username = false;
					document.getElementById("submitButton").disabled = true;
					usernameerrorMsg.style.color = 'red';
					usernameerrorMsg.style.fontSize = '20px';
					usernameerrorMsg.innerHTML = "Username already taken";
				}else{
					if(e.value.length > 4){
						username = true;
						document.getElementById('notice_icon_3').src = "../../website_icon/tick_correct.png";
						if(isValid()){
							document.getElementById("submitButton").disabled = false;
						}
					}else{
						document.getElementById('notice_icon_3').src = "../../website_icon/cross.png";
						username = false;				
						usernameerrorMsg.style.color = 'red';
						usernameerrorMsg.style.fontSize = '20px';
						//document.getElementById('userMsg').innerHTML = "minimun 5 Character";
						document.getElementById("submitButton").disabled = true;
						
					}
				}
				
				showFlag();
			}
		};
		var url = "../../common/checking_username_password.php?username="+e.value;
		console.log(url);
		xmlHTTP.open("GET", url,true);
		xmlHTTP.send();
	}
		//showFlag();	
		//console.log("Called");		
}



	/*
		Here all the field is not empty
		#then checking the password is equal or not
		#Then length of the password
		#then AJAX is used to identify the username and email is already in the databse or not
	*/
//Email validation
function emailValidation(e){
	if(e.value.length < 1){
		document.getElementById('notice_icon_4').style.visibility = "hidden";	
		document.getElementById('emailMsg').innerHTML = '';
	}else{
		document.getElementById('notice_icon_4').style.visibility = "visible";
		var xmlHTTP = new XMLHttpRequest();	
		var emailerrorMsg = document.getElementById('emailMsg');
		emailerrorMsg.innerHTML = '';
		//TODO AJAX for checking email
		xmlHTTP.onreadystatechange = function(){
			
			if(xmlHTTP.readyState == 4 && xmlHTTP.status == 200){
				//console.log(result);
				if(xmlHTTP.responseText == 1 ){
					document.getElementById('notice_icon_4').src = "../../website_icon/cross.png";
					email = false;
					document.getElementById("submitButton").disabled = true;
					emailerrorMsg.style.color = 'red';
					emailerrorMsg.style.fontSize = '20px';
					emailerrorMsg.innerHTML = "Email already taken";
				}
			}else{
				if(e.value.length > 6){
					document.getElementById('notice_icon_4').src = "../../website_icon/tick_correct.png";
					email = true;
					if(isValid()){
						document.getElementById("submitButton").disabled = false;
					}
				}else{
					document.getElementById('notice_icon_4').src = "../../website_icon/cross.png";
					email = false;
					document.getElementById("submitButton").disabled = true;
					
				}
			}
			showFlag();
		};
		
		var url = "../../common/checking_username_password.php?email="+e.value;
		console.log(url);
		xmlHTTP.open("GET", url,true);
		xmlHTTP.send();
	}			
}


//password validation
function passwordValidation( ){
	
	if(document.getElementById("password").value.length < 1 && document.getElementById("repassword").value.length < 1){
		
		document.getElementById('notice_icon_5').style.visibility = "hidden";
		document.getElementById('paserror').innerHTML = "";
		document.getElementById('repaserror').innerHTML = "";

	}else if(document.getElementById("password").value.length > 4){
		
		document.getElementById('notice_icon_5').style.visibility = "visible";
		document.getElementById('paserror').innerHTML = '';
		
		if(  document.getElementById("password").value == document.getElementById("repassword").value ){
			document.getElementById('repaserror').innerHTML = '';	
			document.getElementById('notice_icon_5').src = "../../website_icon/tick_correct.png";   
			pass = true;
			repass = true;
			if(isValid()){
				document.getElementById("submitButton").disabled = false;
			}
		}else{
			console.log("Error");
			document.getElementById('repaserror').style.fontSize = "20px";
			document.getElementById('repaserror').style.color = "red";
			document.getElementById('repaserror').innerHTML = "Password not matched";
			
			document.getElementById('notice_icon_5').src = "../../website_icon/cross.png";
			repass = false;
			pass = false;
			document.getElementById("submitButton").disabled = true;
		}
	}else{
		document.getElementById('notice_icon_5').style.visibility = "visible";
		
		document.getElementById('paserror').style.fontSize = "20px";
		document.getElementById('paserror').style.color = "red";
		document.getElementById('paserror').innerHTML = "Minimum 5 Characters";
	}	
	showFlag();
}
/*

//repassword validation
function repasswordValidation(e){
	if(e.value.length > 4 && (e.value == document.getElementById("password").value)){
		pass = true;
		repass = true;
		if(isValid()){
			document.getElementById("submitButton").disabled = false;
		}
	}else{
		repass = false;
		repass = false;
		document.getElementById("submitButton").disabled = true;
	}
	showFlag();
} */

