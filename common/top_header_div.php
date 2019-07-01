
<?php
	
	
	
	$destination  = "../profile_picture/".$_SESSION["USERID"].".jpg";
	
	//$uname = $_POST['username'];
	//	$pass = $_POST['password'];
	$jsonData = getJSONFromDB("select * from user_table");
	$jsn=json_decode($jsonData);
	foreach($jsn as $v){
		
		//Finding the User
		if($v->USER_ID == $_SESSION["USERID"]){
			
			echo '<div class = "top_header_logged">';
			
			echo '<a href="../" id="home">Rent a Car</a>';
			
			echo '<span id = "name_imge">';	
			echo "Welcome ".$v->FIRST_NAME." !";
			
			if(file_exists($destination)){
				echo '<img src="'.$destination.'" alt="icon" width=40 height=40 >';
			}else{
			//echo "Next ELSE: ".$destination."<br/>";
				echo '<img src="../profile_picture/noimage.jpg" alt="icon" width=40 height=40 >';
			}
			echo '</span>';
			
			echo '<span id="home_link">';
			
			echo '<a href = "../post/post.php" id = "post" name ="POST"  > Post </a>'.'&nbsp;&nbsp;&nbsp';
			//echo '</span>';
			
			//Normal profile link navigation
			if($_SESSION["USERTYPE"] == 'ADMIN_USER'){
				echo '<a href = "../admin/profile/admin_profile.php" id = "profile"> Profile </a>'.'&nbsp;&nbsp;&nbsp';
			}else{
				echo '<a href = "../user/user_profile.php" id = "profile"> Profile </a>'.'&nbsp;&nbsp;&nbsp';
			}
			
			echo '<a href = "../logout/logout.php" id = "logout"> Logout </a>';
			//echo '</span>';
			
			echo '</span>';
			
			echo '</div>';
			break;
		}
	}
?>