/*
	This function is about checking of the picture
	is that really a picture or not
*/

function pictureUpload(){
	//alert("Ok Working");
	var imageAllow = new Array('.jpeg', '.jpg','.JPEG','.JPG','.PNG','.png');
	var flag = false,isImage = false;
	var imageText = document.getElementById('imageFileUploader').value;
	var fileType = imageText.substring(imageText.lastIndexOf('.'),imageText.length);
	//console.log(imageText.length);
	console.log(fileType);
	if(document.getElementById('imageFileUploader').value.length == 0){
		flag = false;
		alert("Please Choose an Image");
	}else{
		for(i = 0; i < imageAllow.length; i++){
			if(imageAllow[i] == fileType){
				flag = true;
				isImage = true;
				break;
			}
				
		}	
	}
	if(!isImage){
		alert("Please Choose Only Image");
	}
	return flag;
}