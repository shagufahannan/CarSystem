<?php
	 
	
	//Search feature Login done here
	if(isset($_POST['search_bttn']))
	{
		$staringRent = $_POST['starting'];
		$endingRent = $_POST['ending'];
		$area = $_POST['area'];
	    if((!empty($staringRent) && !empty($endingRent) && empty($area)) ||(!empty($staringRent) && !empty($endingRent) && !empty($area)))
	     {
		$postTableData = getJSONFromDB("SELECT user_table.FIRST_NAME, user_table.LAST_NAME,user_table.USER_ID,post_table.POST_ID,
		post_table.TITLE,post_table.DETAILS,
		post_table.RENT,post_table.ADDRESS,
		post_table.DATE_TIME FROM user_table INNER JOIN post_table ON user_table.USER_ID=post_table.USER_ID  
		WHERE post_table.POST_ID AND (post_table.RENT >= $staringRent AND post_table.RENT <= $endingRent) AND post_table.ADDRESS LIKE '%$area%' ORDER BY  post_table.POST_ID   DESC");
	     }
		 else if((empty($staringRent) && empty($endingRent) && !empty($area)))
		 {
		 $postTableData = getJSONFromDB("SELECT user_table.FIRST_NAME, user_table.LAST_NAME,user_table.USER_ID,post_table.POST_ID,
		 post_table.TITLE,post_table.DETAILS,
		 post_table.RENT,post_table.ADDRESS,
		 post_table.DATE_TIME FROM user_table INNER JOIN post_table ON user_table.USER_ID=post_table.USER_ID  
		 WHERE post_table.ADDRESS LIKE '%$area%' ORDER BY  post_table.POST_ID  DESC");	
		 }
	      else
		  {

			  echo "empty";
			 
		  }
		
		
	}
	else
	{
		$postTableData = getJSONFromDB("SELECT user_table.FIRST_NAME, user_table.LAST_NAME,user_table.USER_ID,post_table.POST_ID,
		post_table.TITLE,post_table.DETAILS,
		post_table.RENT,post_table.ADDRESS,
		post_table.DATE_TIME FROM user_table INNER JOIN post_table ON user_table.USER_ID=post_table.USER_ID ORDER BY post_table.POST_ID DESC ");
		
	}
	
	$postTable=json_decode($postTableData);
		
	foreach($postTable as $da){
		
		$destination  = "profile_picture/".$da->USER_ID.".jpg";
		
		echo '<div  class = "each_post">';
		
		if(file_exists(  $destination )){
			echo '<div id = "post_iamge_name"><br><img src="'.$destination.'" alt="icon" width=40 height=40 >';
		}else{
			echo '<div id = "post_iamge_name"><br><img src="profile_picture/noimage.jpg" alt="icon" width=40 height=40 >';
		}
		
		$postImageTableData = getJSONFromDB("SELECT * FROM post_image_table WHERE POST_ID = $da->POST_ID");
		$postImageTable = json_decode($postImageTableData);
		$user = $da->USER_ID;
		$fname = $da->FIRST_NAME;
		$lname = $da->LAST_NAME;
		if( !isset($_SESSION["USERID"]) && !isset($_SESSION["USERTYPE"])){echo $fname."&nbsp".$lname;}
		else{
		echo '<a href="profile/profile.php?USER='.$user.'" style="color: #6112d6">'. $fname.' '.$lname.'</a>';}
		echo '</div>';
		echo "<h2 style='color:red'>".$da->TITLE."</h2>";
		echo "<div style = 'color:grey'>".$da->DATE_TIME."</div>"."<br>";
		echo "Details: ".$da->DETAILS."<br>";
			
		foreach($postImageTable as $pa){
			
			$dest = substr($pa->IMAGE_LINK,3);
		
			
			if(file_exists($dest)){
				echo '<img src="'.$dest.'" alt="icon" width=450 height=350 >&nbsp;&nbsp;&nbsp;';
			}
			
		}					
		echo "<br>"."Place:".$da->ADDRESS."<br>";
		echo "Rent: " .$da->RENT." Tk<br>";
		
		echo '</div>';					
							
	}
?>