<?php
	session_start();
	if(isset($_SESSION["USERID"]) && isset($_SESSION["USERTYPE"]))
		header("location:../index.php");
	
	require('../function/functions.php');
?>

<!DOCTYPE>
<html>
	<head>
		<title>Login</title>
		<script type="text/javascript" src="../js/user_login_validation.js"> </script>
		<link rel="stylesheet" type="text/css" href="../css/user_login_design.css">
	</head>
	<body>
	
		<div id = "loginform">
			<?php
				if(isset($_SESSION['login_error'])){
					echo "<h4 style = 'color:red;'>".$_SESSION['login_error']."</h4>";	
					session_unset($_SESSION['login_error']);
				}
				
			?>
			
			
			<h2 id = 'login_header'>Login</h2>
			<form action = "user_login_checking.php" method = "post"> 
			
				<span id = 'username_login_field'>	
				<!--	<span class = 'field_msg'> Username/Email </span> --> 
				<input type="text" placeholder = "Username/Email"  id = "username" name="username"> 
				</span> <br><br>
				
				<span id = 'password_login_field'>
				<!--	<span class = 'field_msg'>Password  </span> -->
				<input type="password" placeholder = "Password" id = "password"   name="password" >	
				</span><br><br>
				<input type="hidden" value ="Login" name ="loginValid">
				<div id='login_btn_div'> 
					<input type="submit" onclick = 'return loginValidation()' id = "loginButton"  value ="Login" name ="loginButton" > 
				</div>
			
			</form>
			Not Registered?<a href = "user_registration.php" id = 'signup_link'>  Sign up </a><br>
			&nbsp; Go to <a href = "index.php" id='home_link'>HOME </a>
		</div>
	</body>
</html>

