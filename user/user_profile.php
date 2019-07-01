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
		if(isset($_SESSION["USERID"]) && $_SESSION["USERTYPE"]){
			
			require('../function/functions.php');
			require("../database/db_fun.php");
			//Adding top header file for showing post/profile/logout
			require('../common/top_header_div.php');	
			
				
			$destination  = "../profile_picture/".$_SESSION["USERID"].".jpg";
			$imageChanged = false;
			//echo "<br/>Prevoius: ".$destination."<br/>";	
			if(isset($_POST['pic_choose_btn'])){
					
				$imageType = $_FILES['propic']['type'];
				$tmp_src = $_FILES['propic']['tmp_name'];
				$imageType = explode('/',$imageType);
				
				if($imageType[0] == 'image'){
					move_uploaded_file($tmp_src,$destination);
					
					$jsoninsertpic="UPDATE user_profile_data_table SET IMAGE = '$destination' WHERE USER_ID  = '".$_SESSION["USERID"]."'" ;
					
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
	?>
		
		<form method = "POST" action = "user_profile.php" enctype = "multipart/form-data" id = "pic_form">
			<input type="file" id = "imageFileUploader" name = "propic"> 
			<input type="submit" onclick = "return pictureUpload()" value = "Change Picture" name = "pic_choose_btn" />
		</form>
		
	<?php
		
		echo '</div>';
		$uID = $_SESSION["USERID"];
		$joiningQuery = "SELECT * FROM user_table  INNER JOIN user_profile_data_table on user_table.USER_ID = user_profile_data_table.USER_ID 
						WHERE user_table.USER_ID = '".$_SESSION["USERID"]."'";
		$jsonData =  getJSONFromDB($joiningQuery);
		$jsn=json_decode($jsonData);
		
		echo '<div id = "basic_info">';
		
		echo "<br><br>Name  :".$jsn[0]->FIRST_NAME."&nbsp".$jsn[0]->LAST_NAME."</br>"."</br>";
		//echo "ID    :".$jsn[0]->USER_ID."</br>"."</br>";
		echo "Email :".$jsn[0]->EMAIL."</br>"."</br>";
		echo "Joined:".$jsn[0]->CREATION_DATE_TIME."</br>"."</br>";
		echo "Phone : <span id='phone_no'>".$jsn[0]->PHONE_NO."</span>"; 
		echo '<input type = "button" id = "'.$uID.'" name ="phone_no_edit" onclick="phoneNoEdit(this)" value="Edit" />';
		echo "<br>Address: <span id = 'address'>".$jsn[0]->ADDRESS."</span> &nbsp;&nbsp;&nbsp;";
		echo '<input type="button" id="'.$uID.'"  name ="address_edit" onclick="addressEdit(this)" value = "Edit" />';
		echo '<p onclick = "showChangePassword()" style ="cursor:pointer; color:red;"> Change Password</p>';
		echo '</div>';
		
		echo '</div>';
	?>
	
	<!-- changae password -->
	<div id = "password_change_div" style="display:none;">
	<form action = "user_profile.php" method="post" id = "changePassForm">
		Old Password <?php space(7); ?><input type = "password" name = "oldpassword" /> <br><br>
		New Password <?php space(4); ?> <input type = "password" name = "newpassword" /> <br><br>
		Re-Password <?php space(7); ?> <input type = "password" name = "newrepassword" /> <br><br>	
		<input type = "submit" onclick = "return passChange()" value = "Change Password" name = "passwordChangeButton" />
		<span style = "cursor:pointer;" onclick="changePasswordHide()"> Cancel</span>
	</form>
	</div>
	<!-- ends here -->
	
	<!-- Change password logic -->
	<?php 
		if(isset($_POST['passwordChangeButton'])){
			$oldpass = $_POST['oldpassword'];
			$newpass = $_POST['newpassword'];
			$newrepass = $_POST['newrepassword'];
			
			$json = json_decode(getJSONFromDB("SELECT PASSWORD FROM USER_TABLE WHERE USER_ID = $uID"));
			if($json[0]->PASSWORD == $oldpass){
				//echo "Hmm... thik ache";
				if( updateDB("UPDATE USER_TABLE SET PASSWORD = '$newpass' WHERE USER_ID = $uID") ){
					$_SESSION['PASS_CHANGE'] = "done";
				}
			}else{
				//echo "nah... Thik nai";
				$_SESSION['PASS_ERROR'] = "error";
			}
			
		}
	?>
	
	<!-- Java script goes here -->
		<script type = "text/javascript">
		    var counter  = 0; 
			function phoneNoEdit(e){
				//document.getElementById('phone_no').innerText = e.id;
				var phoneNumber = prompt("Please enter your Phone Number", "");
				//alert(phoneNumber);
				//document.getElementById('phone_no').innerText = phoneNumber;
				if(phoneNumber.length < 11){
					alert("Enter your Phone Number");
					return;
				}
				var xmlHTTP = new XMLHttpRequest();	
				xmlHTTP.onreadystatechange = function(){
					if(xmlHTTP.readyState == 4 && xmlHTTP.status == 200){
						console.log(xmlHTTP.responseText);
						if(xmlHTTP.responseText == 'ok'){
							document.getElementById('phone_no').innerText = phoneNumber;
						}
					}
				};
				
				var url = "../common/edit_profile.php?phone="+phoneNumber+"&uID="+e.id;
				console.log(url);
				xmlHTTP.open("GET", url,true);
				xmlHTTP.send();
			}
			
			function addressEdit(e){
				//document.getElementById('address').innerText = e.id;
				var address = prompt("Please enter your Address", "");
				//alert(address);
				//document.getElementById('address').innerText = address;
				if(address.length == 0){
					alert("Enter your Address");
					return;
				}
				var xmlHTTP = new XMLHttpRequest();	
				xmlHTTP.onreadystatechange = function(){
					if(xmlHTTP.readyState == 4 && xmlHTTP.status == 200){
						if(xmlHTTP.responseText == 'ok'){
							document.getElementById('address').innerText = address;
						}
					}
				};
				
				var url = "../common/edit_profile.php?address="+address+"&uID="+e.id;
				console.log(url);
				xmlHTTP.open("GET", url,true);
				xmlHTTP.send();
			}
			
			function showChangePassword(){
			
				document.getElementById('password_change_div').style.display = "block";
					
			}
			
			function changePasswordHide(){
				document.getElementById('password_change_div').style.display = "none";
			}
			
			function passChange(){
				var flag = true;
				var oldpass = document.getElementById('changePassForm').oldpassword.value;
				var newpass = document.getElementById('changePassForm').newpassword.value
				var newrepass = document.getElementById('changePassForm').newrepassword.value
				if(oldpass.length != 0){
					if( (newpass != newrepass) || (newpass.length == 0 || newrepass.length == 0)){
						flag = false;
						alert("Password missmatch");
					}
				}else{
					flag = false;
					alert("Enter old password");
				}
				return flag;
			}
			
		</script>
	<!-- JAVASCRIPT ends here -->
	
	<?php 
		if(isset($_SESSION['PASS_CHANGE'])){
			unset($_SESSION['PASS_CHANGE']);
			echo "<script>alert('Passowrd change succesfully');</script>";
		}else if(isset($_SESSION['PASS_ERROR'])){
			unset($_SESSION['PASS_ERROR']);
			echo "<script>alert('Passowrd can not change');</script>";
		}
	?>
	
	</body>
</html>

	
	</body>
</html>
