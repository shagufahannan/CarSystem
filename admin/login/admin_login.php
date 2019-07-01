<?php
	session_start();
	if(isset($_SESSION["USERID"]) && isset($_SESSION["USERTYPE"]))
		header("location:/index.php");
?>
<!DOCTYPE>
<html>
	<head>
		<title>Login</title>
		<script type="text/javascript" src="../../js/user_login_validation.js"> </script>
		<link rel="stylesheet" type="text/css" href="../../css/admin_login_design.css">
	</head>
	<body><!--
		<h2> Admin Login Here </h2>
		<form action = "admin_login_checking.php" method = "post"> 
			Enter Your Username or Email &nbsp <input type="text" onkeyup = "loginValidation()" id = "username" placeholder="Username or Email" name="username"><br><br>
			Enter Your Password &nbsp <input type="password" onkeyup = "loginValidation()" id = "password" placeholder="Password" name="password" ><br><br>
			<input type="hidden" value ="Login" name ="loginValid">
			<input type="submit" id = "loginButton"  value ="Login" name ="loginButton" disabled>
		</form>
		<a href = "../registration/admin_registration.php"> Sign up </a>
		&nbsp; <a href = "index.php"> HOME </a> -->
		<div id = "loginform">
			
			<?php
				if(isset($_SESSION['login_error'])){
					echo "<h4 style = 'color:red;'>".$_SESSION['login_error']."</h4>";	
					session_unset($_SESSION['login_error']);
				}
				
			?>
		
			<h2 id = 'login_header'>Admin Login</h2>
			<form action = "admin_login_checking.php" method = "post">
			
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
					<input type="submit" id = "loginButton" onclick = "return loginValidation()"  value ="Login" name ="loginButton" > 
				</div>
			
			</form>
			Go to <a href = "index.php" id='home_link'>HOME </a>
		</div>
	</body>
</html>

