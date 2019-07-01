<?php

	session_start();
	if( isset($_SESSION["USERID"]) && isset($_SESSION["USERTYPE"]))
		header("location: ../../index.php");

	
	if( isset($_POST["registration"]) ){
		
		//index.phpindex.phpSetting the time zone
		date_default_timezone_set('Asia/Dhaka');
		
		//index.phpindex.phpAdding the database function 
		require("../../database/db_fun.php");
		
		$fName = $_POST["firstname"];
		$lName = $_POST["lastname"];
		$email = $_POST["email"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$repassword = $_POST["repassword"];
	 if (!empty($fName) && !empty($lName)&&!empty($email) && !empty($username) && !empty($password) && !empty($repassword))
	 {	 
		
		if($password == $repassword){
		//	index.phpindex.phpInsert Query
			$insertQuery = "INSERT INTO user_table VALUE(NULL,'".$fName."','".$lName."','".$username."', 'ADMIN_USER','".
			$email."','".$password."','".date('Y-m-d H:i:s a')."')";
		//	index.phpindex.phpecho "<br>".$insertQuery;
			
			if(updateDB($insertQuery)){
				
				//index.phpindex.phpInsert profile data against each user
				
				$searchQuery = "SELECT USER_ID FROM user_table WHERE USER_NAME ='".$username."'";
				$jnDecode = json_decode(getJSONFromDB($searchQuery));
				if(sizeof($jnDecode) == 1){
					//print_r($jnDecode);
					$user_id = $jnDecode[0]->USER_ID;
					$insertQuery = "INSERT INTO user_profile_data_table VALUES(NULL,'$user_id',NULL,NULL,NULL)";
					//print_r($insertQuery);
					if(updateDB($insertQuery))
						echo "New Admin added!";
					else
						echo "Update not suc";
				}
				//die();
				header("location:../login/admin_login.php");
			}
			
		}else{
			echo "Password is not matched";
		}
	 }
	  else
	  {
		  echo "fields are empty";
	  }
		
		
	
	}
	else
	{
	
		header("location:admin_registration.php");
	
	}
?> 