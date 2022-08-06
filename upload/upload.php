<!DOCTYPE html>
<html>
<head>
	<title>File upload</title>
</head>
<body>
	<form method='post' enctype='multipart/form-data'>

		<label>File Upload</label>
		<input type='File' name='file'>
		<input type="submit" name="Submit">
	</form>
</body>
</html>
		<?php
$localhost = 'localhost';
$dbusername='root';
$dbpassword='';
$dbname='Test';
$uploadOk = 1;
#connections
$conn = mysqli_connect($localhost, $dbusername, $dbpassword, $dbname);
if (isset($_POST['Submit']))
{
	#filename with a random number so that similar files don't exist
	$uploads_dir ='C:\xampp\htdocs';
	$pname =$uploads_dir . basename($_FILES['file']['name']);

	#to check if it's an actual file
	$check = filesize($_FILES["file"]["tmp_name"]);
  if($check !== False) {
    echo "File is a document - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not a document.";
    $uploadOk = 0;
  }

  //Check if file already exists
  if (file_exists($pname)){
  	echo 'Sorry, file already exists.';
  	$uploadOk = 0;
  }
	$Filetype = strtolower(pathinfo($pname, PATHINFO_EXTENSION));

  //Allow only certain files
  if($Filetype !='xlsx'){
  	echo "Sorry, only excel and csv files are allowed";
  	$UploadOk = 0;
  }

	#if it fails to upload
	//$tname = $_FILES['files']['tmp_name'];
  	if ($uploadOk == 0) {
  		echo 'Sorry, your file was not uploaded.';
  	} else{ 
	#upload directory
		if(move_uploaded_file($_FILES ['file']['tmp_name'],$pname)){
			echo'File Successfully Uploaded'; 
		}else{
			echo 'Error in uploading file';
		}
	}
}
	#sql query to put in database
	//$sql ='INSERT into fileup(file) VALUES("$pname")';
	//if(mysqli_query($conn,$sql)){
	//	echo'File Successfully Uploaded'; 
	//}
	//else{
	//	echo 'Error in uploading file';
	//}


	#upload directory path/extension
	//$fileExtension = pathinfo($pname, PATHINFO_EXTENSION);
	//$allowedType= array('csv', 'xlx', 'xlsx');
	//if(!in_array($fileExtension, $allowedType)){
	
		//upload your file
	//	$handle = fopen($tname, 'r')
	//	while($myData = fgetcsv($handle, 1000, ',')) !== FALSE){
	//These ones below depends on the names on your database table so it may actually be different
	//		$username = $myData[0];
	//		$email = $myData[1];
	//		$password = $myData[2];

		//	$query = 'insert into excel_table (username, email, password) values('".$username."', '".$email."', '".$password."')';
		//	$run - mysql_query($query);
	//	}
		//if(!$run){
		//	die('Error in uploading file'.mysql_error());
		//}else{?>