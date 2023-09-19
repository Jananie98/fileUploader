<?php 
 
include('connection.php');

// the directrory that the file is being uploaded
$targetDir = "uploads/";
$errMsg = '';
$msg = '';
$uploadOk = 1;
// file extentions
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }

// Check if the file was uploaded
if(isset($_FILES['file'])&&$_FILES['file']['error'] == 0){
	$fileName = basename($_FILES["file"]["name"]);
	$targetPath = $targetDir.$fileName;

	// Check if file already exists
  // if uploadOk == 0 then file should not be uploaded
if (file_exists($fileName)) {
  $errMsg = "Sorry, file already exists";
  $uploadOk = 0;
}
	// moving the file to the target path
if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)){
	// successful movement , writing to the DB
	$sql = "INSERT INTO files (filename, filepath) VALUES ('$fileName', '$targetPath')";

	if($db->query($sql)== true){
		$msg =  "File Upload Successfully!";
	}else{
		$errMsg =  "Error: ".$sql." Error Detail : ".$db->error;
	}

}else{
		$errMsg = "Error Moving the File";
	}

}else{
	$errMsg =  "File not Uploaded";
}

$db->close(); 

?>

<html>  
  <head>
    <title> Aswesuma </title>	
      <link rel = "stylesheet" type = "text/css" href = "style/style.css">

      <style type="text/css">

        body {margin:0;}

      .navbar {
      overflow: hidden;
      background-color: #333;
      position: fixed;
      top: 0;
      width: 100%;
    }

      .navbar a {
      float: right;
      display: block;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
    } 

      .navbar a:hover {
      background: #ddd;
      color: black;
    }

      </style>

   </head>   

   <body>

    <!-- Nav bar -->
    <div class="navbar">
      <a href="logout.php">Log-Out</a>
    </div>
    <!-- End of nav bar -->

    <br><br>
    
   	<!-- Upload View -->

   	<div align = "center">
    <br><br>
      <div style = "width:500px; border: solid 1px #333333; background-color:#f2f2f2; border-radius: 5px; margin-top: 30px" align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:20px;"><b>Aswesuma - File Upload</b></div>    

          <div style = "margin:30px">

            <!-- Form Area -->
            <form action="upload.php" method="POST" enctype="multipart/form-data">
      				<label id="lblFileChooser">Choose file to Upload</label>
        			<input type="file" name="file" id="fileChooser" /> 

              <br><br>

        			<input type="submit" id="btnSubmit" />             
      			</form>
            <!-- End of Form area -->
            
            <!-- Message area -->
            <div style = "font-size:15px; color: red; margin-top:10px">
              <?php echo $errMsg; ?>                     
            </div>   

            <div style = "font-size:15px; color: green; margin-top:10px">
              <?php echo $msg; ?>                    
            </div> 
            <!-- End of message area -->

          </div>                
      </div>            
    </div>
    <!-- End of Upload view -->
  </body>
</html>