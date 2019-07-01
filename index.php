<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title> Search And Rent a Car</title>
		<link rel="stylesheet" type="text/css" href= "css/index_basic_style.css" />
	</head>
	
	<body>
	
	<?php
		if ( isset($_SESSION["USERTYPE"]) && isset($_SESSION["USERID"]) ){
			
			require("database/db_fun.php");
			require("function/functions.php");
			$destination  = "profile_picture/".$_SESSION["USERID"].".jpg";
	
			$uID = $_SESSION["USERID"];
			
			$jsonData = getJSONFromDB("select * from user_table WHERE USER_ID = '$uID'");
			$jsn=json_decode($jsonData);
			$v = $jsn[0];
				
			echo '<div class = "top_header_logged">';
			?>
			
			<!-- Search Feature will be done here -->
				<form action = 'index.php' method = 'post' id = "search_form">
					Rent range <input type = "text" id = "start" name = "starting" placeholder = "start" />
					    <input type = "text" id = "end" name = "ending" placeholder = "end"/>
						Location <input type = "text" id = "area" name = "area" /> 
					    <input type = "submit" onclick="return searchEmpty_validation()" id = "button" name = "search_bttn"value=""/>
				</form>
			<!-- Search feature ends here-->	
			<?php
			echo '<a href="index.php" id="home">Rent a Car</a>';
			echo '<span id = "name_imge">';	
			echo "Welcome ".$v->FIRST_NAME." ";
			if(file_exists($destination)){
				echo '<img src="'.$destination.'" alt="icon" width=40 height=40 >';
			}else{
			//echo "Next ELSE: ".$destination."<br/>";
				echo '<img src="profile_picture/noimage.jpg" alt="icon" width=40 height=40 >';
			}
			echo '</span>';
			
			echo '<span id="home_link">';
			echo '<a href = "post/post.php" id = "post" name ="POST"  > Post </a>'.'&nbsp;&nbsp;&nbsp';
			
			if($_SESSION["USERTYPE"] == 'ADMIN_USER'){
				echo '<a href = "admin/profile/admin_profile.php" id = "profile"> Profile </a>'.'&nbsp;&nbsp;&nbsp';
			}else{
				echo '<a href = "user/user_profile.php" id = "profile"> Profile </a>'.'&nbsp;&nbsp;&nbsp';
			}
			
			echo '<a href = "logout/logout.php" id = "logout"> Sign out </a>';
			echo '</span>';
				
			echo '</div>';
			
			//Showing the post in the home page	
			require('common/home_page.php');
			
		}else {
			
			include("function/functions.php");
			
			echo "<div class ='top_header'>";
			?>
				<!-- Search Feature will be done here
				
				-->	
					
		<!-- Search option  start here-->
			<!-- Search Feature will be done here -->
				<form action = 'index.php' method = 'post' id = "search_form">
					Rent range <input type = "text" id = "start" name = "starting" placeholder = "start" />
					    <input type = "text" id = "end" name = "ending" placeholder = "end"/>
						Location <input type = "text" id = "area" name = "area" />
					    <input type = "submit" onclick="return searchEmpty_validation()" id="button" name = "search_bttn" value="" />
				</form>
				
				<?php
				echo '<a href="index.php" id="home">Rent a Car</a>';
				echo "<a href = 'user/user_login.php' id='account_a' > Sign in !  </a>";
				echo "<a href = 'user/user_registration.php' id='regi_a'> Want to Post Ad? Sign Up </a>";
			?>	
			<!-- Search feature ends here-->
		<!-- -->
	<?php	
			echo '</div><br>';
			/*
							Showing the post in the home page
						*/
			require("database/db_fun.php");	
			require('common/home_page.php');
		}
	?>
	<!--Search java script validation start-->
		<script>
		function searchEmpty_validation()
		{
			var flag = true;
			if((document.getElementById('start').value.length == 0 && document.getElementById('end').value.length == 0 && document.getElementById('area').value.length == 0)
			||(document.getElementById('start').value.length != 0 && document.getElementById('end').value.length != 0 && document.getElementById('area').value.length == 0)
			(document.getElementById('start').value.length == 0 && document.getElementById('end').value.length == 0 && document.getElementById('area').value.length != 0))
			{
			flag = false ;
			alert ("Empty field");
			}
			
			return flag;
		}
		</script>
	</body>
</html>