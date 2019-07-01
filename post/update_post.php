<?php
	session_start();
	 if( !isset($_SESSION["USERID"]) && !isset($_SESSION["USERTYPE"]))
		header("location: ../index.php");
?>
<!DOCTYPE html>
	<html>
		<head>
			<title>POST </title>
			<link rel="stylesheet" type="text/css" href= "../css/header_basic_style.css" />
			<link rel = "stylesheet" type = "text/css" href = "../css/update_post_design.css" />
		</head>
 
	<body>
		<?php
			
			$areaArray = array('Dhaka','Gopalgonj','Sylhet','Rangpur','Barisal','Noakhali','Chittagong',
			'Chandpur','Coxs Bazar','Sreemangal','Rajshahi','Bogra','Comilla');
			
			//Added function include file
			include('../function/functions.php');
			require("../database/db_fun.php");
			require('../common/top_header_div.php');
			
			if(isset($_POST['updateId'])){
	//show data in text
				$_SESSION['up_id'] = $_POST['updateId'];
				
				//print_r($showUpdate);
		    }
			$update = $_SESSION['up_id'];
			$updateData = getJSONFromDB("SELECT * FROM post_table WHERE POST_ID = $update");
			$showUpdate = json_decode($updateData);
		?>
		
		<!-- <a href = "../index.php"> HOME </a><br><br> -->	
		<?php 
			$u = $_SESSION["USERID"];
		//$update = $_GET['updateId'];
			$add = explode(',',$showUpdate[0]->ADDRESS);
			
		?>
		<div id = "update_form_div">
		
		<form method = "POST" action = "update_post.php?updateIdd=<?php echo $update; ?> " enctype ="multipart/form-data">	
		Post Title: <input type="text" name = "titleText" placeholder = "Enter the title here" value = "<?php echo $showUpdate[0]->TITLE; ?>" /> <br><br>
		
		Select Location : &nbsp 
		<select name = "city">
	  	<option value="Dhaka">Dhaka</option>
		</select><br><br>
		Address: <input type = "text" name = "adress" value = <?php echo $add[0]; ?>>
		Select Destination : &nbsp
		<select name = "area">
	  	<?php
			for($i=0;$i<sizeof($areaArray);$i++)
			{
			   echo '<option value="'.$areaArray[$i].'">'.$areaArray[$i].'</option>';
			}
		?>
		</select> <br><br>
		Rent: <input type = "text" name = "rentText" value = <?php echo $showUpdate[0]->RENT; ?>><br><br>
		Description(optional):<br><br><textarea rows="4" cols="50" name = "describText" > <?php echo $showUpdate[0]->DETAILS; ?> </textarea><br><br>

		<br><br><input type="submit" onclick = "return add_post_validation()" id = "update_buttn" name = "updateBtn" value= "UPDATE" />
	</form>
	</div>

	<?php
//Update process	
		if(isset($_POST["updateBtn"]))
		{ 
			//echo "UPDATE";
			// if(isset($_GET['?updateIdd']))
			if(isset($_POST["titleText"]))
			{	
				$up= $update;
				//if(isset($_POST["titleText"])){ $title = $_POST["titleText"];}
				$title = $_POST["titleText"];
				$place = $_POST["city"]." To ".$_POST["adress"].",".$_POST["area"]."."; 
				$rent = $_POST["rentText"];
				$descrip = $_POST["describText"];
				//echo "UPDATE";
			  if(!empty($title) && !empty($place) && !empty($rent))
				{
					//echo "UPDATE222";
					$updateQuery="UPDATE post_table SET TITLE = '$title', ADDRESS = '$place', RENT = $rent, DETAILS = '$descrip' WHERE POST_ID = $up";
					//echo "UPDATE done";
					updateDB($updateQuery);
					
					header("location:post.php");
					
				   //echo "done";
				}	
			}	
		}	
	?>
	
	<script type = "text/javascript">
		function add_post_validation(){
			var flag =  true;
			var postTitle = document.forms[0].titleText.value;
			var postAddress = document.forms[0].adress.value;
			var postCity = document.forms[0].city.value;
			var postArea = document.forms[0].area.value;
			var postRent = document.forms[0].rentText.value; 
			
			console.log(postTitle+" "+postAddress+ "  "+postCity+" "+postArea+"  "+postRent );
			if( postTitle.length == 0 || postAddress.length == 0 || postCity.length == 0 || 
				postArea.length == 0|| postRent.length == 0){
					flag = false;
					alert("Required fields empty");
				}
			
			return flag;
		}
	</script>
	
</html>	