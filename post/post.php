<?php
	session_start();
	if(!isset($_SESSION["USERID"]) && !isset($_SESSION["USERTYPE"]))
		header("location: ../index.php");
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>POST </title>
		<link rel="stylesheet" type="text/css" href= "../css/header_basic_style.css" />
		<link rel="stylesheet" type="text/css" href= "../css/post_page_design.css" />
	</head>
	<body>
		<?php
			
			$areaArray = array('Dhaka','Gopalgonj','Sylhet','Rangpur','Barisal','Noakhali','Chittagong',
			'Chandpur','Coxs Bazar','Sreemangal','Rajshahi','Bogra','Comilla');
			
			//Added function include file
			
			include('../function/functions.php');
			require("../database/db_fun.php");
			//Adding top header file for showing post/profile/logout
			require('../common/top_header_div.php');
			
		
		?>
		
		
		<!-- Button for new post and showing existing post -->
		
		<!-- -->
		
		
		

	<?php

	/*
		This code is for post
		User or admin can post their post
	*/
	if( isset($_POST["post_button"]) ){
			
		$title = $_POST["titleText"];
		$place = $_POST["city"]." To ".$_POST["adress"].",".$_POST["area"]."."; 
		$rent = $_POST["rentText"];
		$descrip = $_POST["describText"];
		$uID = $_SESSION["USERID"];
		$postTime = date('Y-m-d H:i:s a');
		date_default_timezone_set('Asia/Dhaka');
		//echo $uID."   = >   ".$postTime."<br>";
		//die();
		if(!empty($title) && !empty($place) && !empty($rent)){
		 
			$insertQuery = "INSERT INTO post_table VALUE(NULL,$uID,'".$title ."','".$descrip."','".
					$place."',$rent,'".$postTime."')";
			
			if(updateDB($insertQuery)){
				
				//echo "POST added";
				$searchQuery = "SELECT POST_ID FROM post_table WHERE USER_ID = $uID AND DATE_TIME = '$postTime'";
				$jnDecode = json_decode(getJSONFromDB($searchQuery));	
				
				if(sizeof($jnDecode) == 1){
				//print_r($jnDecode);
					$post_id = $jnDecode[0]->POST_ID;
					
					/*
						This code is for image 
						upload in post_image_table
						here i am checking for is that file is image or not
					*/
					
					$imageCounter = 100;
					$destination = '../post_picture/image_'.$post_id.'_'.$imageCounter.'.jpg';
					foreach($_FILES as $file){
						
						$imageType = explode('/',$file["type"]);
						if($imageType[0] == 'image'){
								/*
									Moving the image into post_image folder
								*/
								move_uploaded_file($file['tmp_name'],$destination);		
								$imageInsertQujery = "INSERT INTO post_image_table VALUES (NULL,$post_id,'$destination')" ;
								
								if(updateDB($imageInsertQujery)){
									$imageCounter += 1;
									$destination = '../post_picture/image_'.$post_id.'_'.$imageCounter.'.jpg';
								}else{
									//echo "Error: failed to Stored Pic in DB<br/>";
								}
						}
					}
					
					echo '<script> alert("Succesfully Posted your post"); </script>';
					
					
				
				}
			}	
		}else{
			echo "Fields are empty!!!!!!!!";
	    }
		
				
	}
	
	
	if($_SESSION["USERTYPE"] == "ADMIN_USER"){
		
		echo '<Button id = "ad_new_post" onclick = "admin_new_post()" align = "center", style= "cursor:pointer"> Add New post </Button>
			<Button id = "my_post" onclick = "admin_my_post()" style= "cursor:pointer"> My Post </Button>
			<Button id = "all_post" onclick = "all_post_div()" style= "cursor:pointer"> All Post </Button>';
		
		//This is for all Post	
		$postTableData = getJSONFromDB("SELECT user_table.FIRST_NAME, user_table.LAST_NAME,user_table.USER_ID,post_table.POST_ID,
						post_table.TITLE,post_table.DETAILS,
						post_table.RENT,post_table.ADDRESS,
						post_table.DATE_TIME FROM user_table INNER JOIN post_table ON 
						user_table.USER_ID=post_table.USER_ID ORDER BY post_table.POST_ID DESC ");
				
		$postTable=json_decode($postTableData);
		
		echo '<div id = "all_post_table_div" style="display:none;">';
				echo '<table id = "all_post_table" style="width:100%">'; 
			
					echo '<tr>';
						echo '<th> Post By </th>';
						echo '<th> Post Title </th>';
						echo '<th> Post Date </th>';
						echo '<th> Post Details </th>';
						echo '<th> Post Image </th>';
						echo '<th> Location/Destination </th>';
						echo '<th> Rent </th>';
						echo '<th> Delete </th>';
					echo '</tr>';
					
		foreach($postTable as $da){
			
			$destination  = "../profile_picture/".$da->USER_ID.".jpg";
			
			
			
			if(file_exists(  $destination )){
				//echo '<br><img src="'.$destination.'" alt="icon" width=40 height=40 >';
			}else{
				//echo '<br><img src="../profile_picture/noimage.jpg" alt="icon" width=80 height=80 >';
			}
			
			$postImageTableData = getJSONFromDB("SELECT * FROM post_image_table WHERE POST_ID = $da->POST_ID");
			$postImageTable = json_decode($postImageTableData);
			echo '<tr>'; 
			echo "<td>". $da->FIRST_NAME."&nbsp". $da->LAST_NAME."</td>"  ;
			echo "<td>".$da->TITLE."</td>";
			echo "<td>".$da->DATE_TIME."</td>";
			echo "<td>".$da->DETAILS."</td>";
			
			echo "<td>";		
			foreach($postImageTable as $pa){
		
				$dest = substr($pa->IMAGE_LINK,0);
				if(file_exists($dest)){
					echo '<img src="'.$dest.'" alt="icon" width=50 height=50 >';
				}
			
			}	 
			echo "</td>";
			
			$recordid = $da->POST_ID;	
			
			echo "<td>"."Place:".$da->ADDRESS."</td>";
			echo "<td>" .$da->RENT." Tk</td>";
			//echo "<td><a href='post_delete.php?recordId=$recordid' style= 'text-decoration:none; color: red;' >Delete This Post</a></td>";
			?>
				<!--  This code is for other's delete post -->
		<form id = "post_delete_form" method = "POST" action =  "post_delete.php">
			<input type = "hidden" name = "recordId" value = "<?php echo $recordid; ?>" />
			<td><input type = "submit" name = "deleteBtn" value = "Delete this POST"></td>
		</form>
		<?php	echo '</tr>';	
		}
		echo '</table>';
		echo '</div>';
		
		
		//This is for only admin post
		
		$ID = $_SESSION["USERID"];
		
		$postTableData=getJSONFromDB("SELECT user_table.FIRST_NAME, user_table.LAST_NAME,user_table.USER_ID,post_table.POST_ID,
		post_table.TITLE,post_table.DETAILS,
		post_table.RENT,post_table.ADDRESS,
		post_table.DATE_TIME FROM user_table INNER JOIN post_table ON 
		user_table.USER_ID=post_table.USER_ID AND user_table.USER_ID=$ID ORDER BY post_table.POST_ID DESC ");
		$posttable=json_decode(	$postTableData);
		//print_r($posttable);
		$postTable=json_decode($postTableData);
		
		echo '<div id = "my_table">';
		echo '<table id = "post_table" style="width:100%">'; 
		
			echo '<tr>';
				echo '<th> Post Title </th>';
				echo '<th> Post Date </th>';
				echo '<th> Post Details </th>';
				echo '<th> Post Image </th>';
				echo '<th> Location/Destination </th>';
				echo '<th> Rent </th>';
				echo '<th> Delete </th>';
				echo '<th> Update Post</th>';

			echo '</tr>';	
		
		
		
		foreach($postTable as $da){
			
			$postImageTableData = getJSONFromDB("SELECT * FROM post_image_table WHERE POST_ID = $da->POST_ID");
			$postImageTable = json_decode($postImageTableData);
			
			echo '<tr>';
				echo '<td>'; echo $da->TITLE; echo '</td>';
				echo '<td>'; echo $da->DATE_TIME; echo '</td>'; 
				echo '<td>'; echo $da->DETAILS; echo '</td>';
				
				echo '<td>';	
				foreach($postImageTable as $pa){
				
					$dest = substr($pa->IMAGE_LINK,0);
											
					if(file_exists($dest)){
						echo '<img src="'.$dest.'" alt="icon" width=50 height=50 >&nbsp;&nbsp;&nbsp;'; 
					}
				}
				echo '</td>';	
				
				$recordid = $da->POST_ID;	
				echo '<td>'; echo $da->ADDRESS; echo '</td>';
				echo '<td>'; echo  $da->RENT." TK"; echo '</td>';
		?>
				<!--  This code is for delete and 
			  Edit the post
		-->
		<form id = "post_delete_form" method = "POST" action =  "post_delete.php">
		
			<input type = "hidden" name = "recordId" value = "<?php echo $recordid;?>" />
			<td><input type = "submit" name = "deleteBtn" value = "Delete this POST"></td>
		</form>
		
		<form id = "post_edit_form" method = "POST" action =  "update_post.php">
			<input type = "hidden" name = "updateId" value = "<?php echo $recordid; ?>" />
			<td><input type = "submit" name = "updateBtn" value = "Edit this POST"></td>
		</form>
		<!-- -->
		<?php	
			echo '</tr>';
				
				//echo "<hr>";
		}
		echo '</table>';
		echo '</div>';
		
		
		 
	}else if($_SESSION["USERTYPE"] == "AUTH_USER"){
		
		echo '<Button id = "ad_new_post" onclick = "user_new_post()" style= "cursor:pointer"> Add New post </Button>
		<Button id = "my_post" onclick = "user_my_post()" style= "cursor:pointer"> My Post </Button>';
		
		$ID = $_SESSION["USERID"];
		
		$postTableData=getJSONFromDB("SELECT user_table.FIRST_NAME, user_table.LAST_NAME,user_table.USER_ID,post_table.POST_ID,
		post_table.TITLE,post_table.DETAILS,
		post_table.RENT,post_table.ADDRESS,
		post_table.DATE_TIME FROM user_table INNER JOIN post_table ON 
		user_table.USER_ID=post_table.USER_ID AND user_table.USER_ID=$ID ORDER BY post_table.POST_ID DESC ");
		$posttable=json_decode(	$postTableData);
		//print_r($posttable);
		$postTable=json_decode($postTableData);
		
		echo '<div id = "my_table">';
		echo '<table id = "post_table" style="width:100%">'; 
		
			echo '<tr>';
				echo '<th> Post Title </th>';
				echo '<th> Post Date </th>';
				echo '<th> Post Details </th>';
				echo '<th> Post Image </th>';
				echo '<th> Location/Destination </th>';
				echo '<th> Rent </th>';
				echo '<th> Delete </th>';
				echo '<th> Update Post</th>';
			echo '</tr>';	
		
		
		
		foreach($postTable as $da){
			
			$postImageTableData = getJSONFromDB("SELECT * FROM post_image_table WHERE POST_ID = $da->POST_ID");
			$postImageTable = json_decode($postImageTableData);
			
			echo '<tr>';
				echo '<td>'; echo $da->TITLE; echo '</td>';
				echo '<td>'; echo $da->DATE_TIME; echo '</td>'; 
				echo '<td>'; echo $da->DETAILS; echo '</td>';
				
				echo '<td>';	
				foreach($postImageTable as $pa){
				
					$dest = substr($pa->IMAGE_LINK,0);
											
					if(file_exists($dest)){
						echo '<img src="'.$dest.'" alt="icon" width=50 height=50 >&nbsp;&nbsp;&nbsp;'; 
					}
				}
				echo '</td>';	
				
				$recordid = $da->POST_ID;			
				echo '<td>'; echo $da->ADDRESS; echo '</td>';
				echo '<td>'; echo  $da->RENT." TK"; echo '</td>';
		?>		
		
		<!--  This code is for delete and 
			  Edit the post
		-->
		<form id = "post_delete_form" method = "POST" action =  "post_delete.php">
			<input type = "hidden" name = "recordId" value = "<?php echo $recordid; ?>" />
			<td><input type = "submit" name = "deleteBtn" value = "Delete this POST"></td>
			<!--<p onclick = "deletePOst(this)" style='text-decoration:none;  color: red; cursor: pointer;'>DELETE THIS POST</p> -->
		</form>
		
		<form id = "post_edit_form" method = "POST" action =  "update_post.php">
			<input type = "hidden" name = "updateId" value = "<?php echo $recordid; ?>" />
			<td><input type = "submit" name = "updateBtn" value = "Edit this POST"></td>
			<!-- <p  onclick = "editPOst(this)"  style='text-decoration:none;color: red; cursor: pointer;'>Edit Post</p> -->
		</form>
		<!-- -->
		<?php	
					
				echo '</tr>';
					
					//echo "<hr>";
		}
			echo '</table>';
			echo '</div>';
		}
		
		?>
	
	<!-- New Post FORM Div starts here -->
		<div id = 'post_ad' style = 'display:none;'>	
		
			<h2>Add New Post</h2>
			<form method = "POST" action = "post.php" name = "new_post_form" enctype ="multipart/form-data">	
				TITLE: <input type="text" name = "titleText" placeholder = "Enter the title here">  <br><br>
				
				Location : &nbsp 
				<select name = "city">
			  	<option value="Dhaka">Dhaka</option>
				</select>  <?php space(5); ?><br><br>
				Address: <input type = "text" name = "adress" placeholder = "Type your address">
				Destination : &nbsp
				<select name = "area">
			  	<?php
					for($i=0;$i<sizeof($areaArray);$i++)
					{
					   echo '<option value="'.$areaArray[$i].'">'.$areaArray[$i].'</option>';
					}
				?>
				</select> <br><br>
				Rent: <input type = "text" name = "rentText" placeholder = "Enter the amount"><br><br>
				Description(optional):<br><br><textarea rows="4" cols="50" name = describText placeholder="Describe here..."></textarea><br><br>
				
				<input type="file" name = "postpic1"><?php echo space(2); ?> <br>
				<input type="file" name = "postpic2"><?php echo space(2); ?> <br>
				<input type="file" name = "postpic3"><?php echo space(2); ?> <br><br>
				<input type="submit" onclick = "return add_post_validation()"  id = 'ad_post_button' name = "post_button" value= "POST" />	
			</form>
		</div>
		<!-- New Post FORM Div starts here -->
		
		
		<!--
			Javascript
		-->
		<script> 
			
			function admin_new_post(){
				document.getElementById('post_ad').style.display = 'block';
				document.getElementById('all_post_table_div').style.display = 'none';
				document.getElementById('my_table').style.display = 'none';
			}
			
			function admin_my_post(){
				document.getElementById('post_ad').style.display = 'none';
				document.getElementById('all_post_table_div').style.display = 'none';
				document.getElementById('my_table').style.display = 'block';
			}
			
			function all_post_div(){
				document.getElementById('post_ad').style.display = 'none';
				document.getElementById('all_post_table_div').style.display = 'block';
				document.getElementById('my_table').style.display = 'none';
			}
			
			function user_new_post(){
				document.getElementById('my_table').style.display = 'none';
				document.getElementById('post_ad').style.display = 'block';
			}
			
			function user_my_post(){
				document.getElementById('my_table').style.display = 'block';
				document.getElementById('post_ad').style.display = 'none';
			}
			
	
			
			function add_post_validation(){
				var flag =  true;
				var postTitle = document.new_post_form.titleText.value;
				var postAddress = document.new_post_form.adress.value;
				var postCity = document.new_post_form.city.value;
				var postArea = document.new_post_form.area.value;
				var postRent = document.new_post_form.rentText.value; 
				
				console.log(postTitle+" "+postAddress+ "  "+postCity+" "+postArea+"  "+postRent );
				if( postTitle.length == 0 || postAddress.length == 0 || postCity.length == 0 || 
					postArea.length == 0|| postRent.length == 0){
						flag = false;
						alert("Required fields empty");
					}
				//alert("working");
				return flag;
			}
			
			function deletePOst(e){
				document.getElementById('post_delete_form').submit();
				//alert("working");
			}
			
			function editPOst(e){
				document.getElementById('post_edit_form').submit();
			}
			
		</script>
		
		<!-- Javascript ENDS HERE -->
		
	
</body>	
</html>