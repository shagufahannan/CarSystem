 <?php
	session_start();
	if(isset($_SESSION["USERID"]) && isset($_SESSION["USERTYPE"]))
		header("location: ../index.php");
	require('../function/functions.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title> SignUp to post and many more ... </title>
		<link rel = 'stylesheet' type = 'text/css' href = '../css/user_registration_design.css' />
		<script type="text/javascript" src="../js/registration_validation.js"></script>
	</head>
	<body>
		
		
		
		<div id = "registration_form">
			<h2 id = 'form_title'> Create New Account </h2>
			<form action = "user_regi_check.php" method = "POST">
			
				<span id = 'fname_field'>
					<input type = "text" id = "fname" onkeyup = "firstNameValidation(this)" placeholder = "First Name"  name = "firstname"  /> 
				</span>
				<img src="../website_icon/cross.png" id = "notice_icon_1" width=20px height=20px style="visibility:hidden;" /> 
				<br><br>
				
				<span id = 'lname_field'>	
					<input type = "text" id = "lname" onkeyup = "lastNameValidation(this)" placeholder = "Last Name" name = "lastname"  /> 
				</span>	
				<img src="../website_icon/cross.png" id = "notice_icon_2" width=20px height=20px style="visibility:hidden;" />
				<br><br>
				
				<span id = 'username_field'>	
					<input type = "text" id = "username" onkeyup = "usernameValidation(this)" placeholder = "Username" name = "username" />  
				</span>	
				<img src="../website_icon/cross.png" id = "notice_icon_3" width=20px height=20px style="visibility:hidden;" />
				<span id = "userMsg"></span> 
				<br><br>
				
				<span id = 'email_field'>		
					<input type = "text" id = "email"  onkeyup = "emailValidation(this)" placeholder = "Email" name = "email"  /> 
				</span>
				<img src="../website_icon/cross.png" id = "notice_icon_4" width=20px height=20px style="visibility:hidden;" />
				<span id = "emailMsg"></span>		
				<br><br>
				
				<span id = 'password_field'>		
					<input type = "password" onkeyup ="passwordValidation()" placeholder = "Password" id = "password" name = "password"  /> 
				</span>
				<img src="../website_icon/cross.png" id = "notice_icon_5" width=20px height=20px style="visibility:hidden;" />
					
				<span id="paserror"> </span>
				<br><br>
				
				<span id = 'repassword_field'>		
					<input type = "password" onkeyup ="passwordValidation()" placeholder = "Re-password" id = "repassword" name = "repassword" /> 
				
				</span>
				<img src="../website_icon/cross.png" id = "notice_icon_6" width=20px height=20px style="visibility:hidden;" />
				<span id="repaserror"> </span>		
				
				<br><br>
				<input type = "hidden" name = "registration" value = "valid" />
				
				<div id='regi_btn_div'>
					<input type = "submit"  id = "submitButton"   name = "user_signup_button" value = "Create Account" disabled />
					<img src="../website_icon/cross.png" id = "notice_icon_7" width=20px height=20px style="visibility:hidden;" />
				</div>
			</form>	
				Have Account? <a href = "user_login.php" id = "login_link"> Login </a> <br>
			&nbsp; Go to <a href = "index.php" id = "home_link">Home </a>	
		</div>		
			
		<script>
				
		</script>
		
	</body>
</html>