<!DOCTYPE html>
<html>
	<head>
		<title> SignUp to post and many more ... </title>
		<link rel = 'stylesheet' type = 'text/css' href = '../../css/admin_registration_design.css' />
		<script type="text/javascript" src="../../js/admin_registration_validation.js"> </script>
	</head>
	<body><!--
		<h2> Admin SignUp Here </h2>
		<form action = "admin_regi_check.php" method = "POST">
			
			Enter Your First Name <input type = "text" onkeyup = "firstNameValidation(this)"  name = "firstname" placeholder = "First Name" /> 
			<img src="../../website_icon/cross.png" id = "notice_icon_1" width=20px height=20px style="visibility:hidden;" /> 
			<br><br>
			Enter Your Last Name <input type = "text" onkeyup = "lastNameValidation(this)" name = "lastname" placeholder = "Last Name" /> 
			<img src="../../website_icon/cross.png" id = "notice_icon_2" width=20px height=20px style="visibility:hidden;" />
			<br><br>
			Enter Your User Name <input type = "text" id = "username" onkeyup = "usernameValidation(this)" name = "username" placeholder = "User Name" />  
			<img src="../../website_icon/cross.png" id = "notice_icon_3" width=20px height=20px style="visibility:hidden;" />
			<span id = "userMsg"></span> 
			<br><br>
			Enter Your Email <input type = "text" id = "email"  onkeyup = "emailValidation(this)" name = "email" placeholder = "Email" /> 
			<img src="../../website_icon/cross.png" id = "notice_icon_4" width=20px height=20px style="visibility:hidden;" />
			<span id = "emailMsg"></span> 
			<br><br>
			Enter Your Password <input type = "password" onkeyup ="passwordValidation()" id = "password" name = "password" placeholder = "Passwrod" /> 
			<img src="../../website_icon/cross.png" id = "notice_icon_5" width=20px height=20px style="visibility:hidden;" />
			<span id="paserror"> </span>
			<br><br>
			Enter Your Re-Password <input type = "password" onkeyup ="passwordValidation()" id = "repassword" name = "repassword" placeholder = "Re-Passwrod" /> 
			<input type = "hidden" name = "registration" value = "valid" />
			<span id="repaserror"> </span><br><br>
			<input type = "submit" id = "submitButton"  name = "user_signup_button" value = "SignUp" disabled />
			
		</form>
		
		<a href = "../Login/admin_login.php"> Login </a> -->
		
		<div id = "registration_form">
			<h2 id = 'form_title'> Create New Account for Administration</h2>
			<form action = "admin_regi_check.php" method = "POST">
			
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
				Have Account? <a href = "../Login/admin_login.php" id = "login_link"> Login </a> <br>
			&nbsp; Go to <a href = "index.php" id = "home_link">Home </a>	
		</div>
	</body>
</html>