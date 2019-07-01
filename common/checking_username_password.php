<?php
	require('../database/db_fun.php');
	if(isset($_GET['email'])){
		$email = $_GET['email'];
		$query = "SELECT * FROM USER_TABLE WHERE EMAIL = '$email';";
		if( sizeof( json_decode(getJSONFromDB($query))) ){
			echo 1;
		}else{
			echo 0;
		}
	
	}else if(isset($_GET['username'])){
		
		$username = $_GET['username'];
		$query = "SELECT * FROM USER_TABLE WHERE USER_NAME = '$username';";
		if( sizeof( json_decode(getJSONFromDB($query))) ){
			echo 1;
		}else{
			echo 0;
		}
	}
?>