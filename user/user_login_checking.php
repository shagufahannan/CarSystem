
<?php
	
	session_start();
	if(isset($_SESSION["USERID"]) && $_SESSION["USERTYPE"])
		header("location: ../index.php?posts=0");
	
	if(isset($_POST['loginValid'])){
		require("../database/db_fun.php");
			if (empty($_POST['username']) || empty($_POST['password'])) {
						echo "fileds are empty!!!!!!!!";
			}
			else{
				$uname = $_POST['username'];
				$pass = $_POST['password'];
				$jsonData = getJSONFromDB("select * from user_table");
				
				
				$jsn=json_decode($jsonData);
				// echo "<pre>";
				// print_r($jsn);
			// 	 echo "</pre>";
				// die();
			   $loginStatus = false;	
			   foreach($jsn as $v){
				   
					if((($uname == $v->USER_NAME && $pass== $v->PASSWORD ) || ($uname == $v->EMAIL && $pass == $v->PASSWORD))
						&& $v->USER_TYPE == "AUTH_USER"){
						$_SESSION["USERID"] = $v->USER_ID;
						$_SESSION["USERTYPE"] = $v->USER_TYPE;
						echo "Welcome ".$v->FIRST_NAME." User Type: ".$v->USER_TYPE ;
						$loginStatus = true;
						header("location:../index.php");
						// break;
					}
				}
				
				if(!$loginStatus){
					$_SESSION['login_error'] = "Wrong Username/Email Or Password";
					header("location: user_login.php");
				}
			}
		 
		   
		}
	else {
		header("location: user_login.php");

	}
?>
 
