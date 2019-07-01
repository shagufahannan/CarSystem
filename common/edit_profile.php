<?php
	require('../database/db_fun.php');
	if(isset($_GET['phone']) && isset($_GET['uID'])){
		//echo $_GET['phone']."  ".$_GET['uID'];
		$number = $_GET['phone'];
		$uid = $_GET['uID'];
		$sql = "UPDATE user_profile_data_table SET PHONE_NO = '$number' WHERE USER_ID = $uid";
		//echo $sql;
		if(updateDB($sql)){
			echo 'ok';
		}else{
			echo 'error';
		}
	}else if(isset($_GET['address']) && isset($_GET['uID'])){
		//echo $_GET['address']."  ".$_GET['uID'];
		$address = $_GET['address'];
		$uid = $_GET['uID'];
		$sql = "UPDATE user_profile_data_table SET ADDRESS = '$address' WHERE USER_ID = $uid";
		if(updateDB($sql)){
			echo 'ok';
		}else{
			echo 'error';
		}
	}
?>