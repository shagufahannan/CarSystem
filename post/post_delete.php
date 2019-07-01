<?php
//DELETE POST 
	include('../function/functions.php');
	require("../database/db_fun.php");
	
	if(isset($_POST['recordId'])){ 
		$_SESSION['del_id'] = $_POST['recordId'];
		
		
		$g=$_SESSION['del_id'];					 
		 $delete_data = "DELETE FROM post_image_table where POST_ID = $g";
		//check if post_ID exists on imagetable then execute updateDB($del)
		if(updateDB($delete_data)){
			// //echo "<script>alert('Pictures REMOVED')</script>";
		
		 $delete_post = "DELETE FROM post_table where POST_ID = $g";
		 updateDB($delete_post);
		 header('location:../post/post.php');}
			// //if picture not available
			 else {	$delete_post = "DELETE FROM post_table where POST_ID = $g";
	     updateDB($delete_post);}
		header('location:../post/post.php');}
	
	
?>