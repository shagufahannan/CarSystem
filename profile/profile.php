<?php
	 session_start();
	 if( !isset($_SESSION["USERID"]) && !isset($_SESSION["USERTYPE"]))
		 header("location: ../index.php");
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Profile </title>
	    <script type="text/javascript" src="../js/image_validation.js"> </script>
		<link rel="stylesheet" type="text/css" href= "../css/header_basic_style.css" />
		<link rel="stylesheet" type="text/css" href= "../css/user_profile_design.css" />
	</head>
	<body>
	
	<?php
		// if(isset($_SESSION["USERID"]) && $_SESSION["USERTYPE"]){
	  if(isset($_GET['USER']))
		{	
            $u=$_GET['USER'];
			require('../function/functions.php');
			require("../database/db_fun.php");
			//Adding top header file for showing post/profile/logout
			require('../common/top_header_div.php');	
			
				
			$destination  = "../profile_picture/$u.jpg";
			$imageChanged = false;
			//echo "<br/>Prevoius: ".$destination."<br/>";	
			if(isset($_POST['pic_choose_btn'])){
					
				$imageType = $_FILES['propic']['type'];
				$tmp_src = $_FILES['propic']['tmp_name'];
				$imageType = explode('/',$imageType);
				
				if($imageType[0] == 'image'){
					move_uploaded_file($tmp_src,$destination);
					
					$jsoninsertpic="UPDATE user_profile_data_table SET IMAGE = '$destination' WHERE USER_ID  = $u";
					
					if(updateDB($jsoninsertpic)){
						$imageChanged = true;
					}else{
						//echo "Error: failed to Stored Pic in DB<br/>";
					}
				}else{
					//echo "<script> alert('Please Insert an Image') </script>";
				}
			}
				
			echo '<div id = "profile_div">';	
				
				echo '<div id = "pic_div">';
				if(file_exists($destination)){
					//echo "Next IF: ".$destination."<br/>";
					echo '<br><img id = "pro_pic" src="'.$destination.'" alt="icon" width=150 height=150 >'."<br><br>";
					
					//if($imageChanged)
						//echo "<script> alert('Your Image Changed') </script>";
					
				}else{
					//echo "Next ELSE: ".$destination."<br/>";
					echo '<br><img id = "pro_pic" src="../profile_picture/noimage.jpg" alt="icon" width=150 height=150 >'."<br><br>";
				}
			
		}		
	
		
		
	
		
		echo '</div>';
		$uID = $_SESSION["USERID"];
		$joiningQuery = "SELECT * FROM user_table  INNER JOIN user_profile_data_table on user_table.USER_ID = user_profile_data_table.USER_ID 
						WHERE user_table.USER_ID =$u";
		$jsonData =  getJSONFromDB($joiningQuery);
		$jsn=json_decode($jsonData);
		
		echo '<div id = "basic_info">';
		
		echo "<br><br>Name  :".$jsn[0]->FIRST_NAME."&nbsp".$jsn[0]->LAST_NAME."</br>"."</br>";
		//echo "ID    :".$jsn[0]->USER_ID."</br>"."</br>";
		echo "Email :".$jsn[0]->EMAIL."</br>"."</br>";
		echo "Joined:".$jsn[0]->CREATION_DATE_TIME."</br>"."</br>";
		echo "Phone : <span id='phone_no'>".$jsn[0]->PHONE_NO."</span>"; 
		echo "<br>Address: <span id = 'address'>".$jsn[0]->ADDRESS."</span> &nbsp;&nbsp;&nbsp;";
		echo '</div>';
		
		echo '</div>';
	
	
	
	?>
	
	

	
