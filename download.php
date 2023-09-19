<html>
 <head>
 	<title> Aswesuma </title>	
   	<link rel="stylesheet" type="text/css" href="./style/style.css">
    <style>

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

	<!-- Download View -->
    <div align = "center">
    <br><br>
    	<div style = "width:1000px; border: solid 1px #333333; background-color:#f2f2f2; border-radius:5px; margin-top:30px" align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:20px;"><b>Aswesuma - Download</b></div>
                
            <div style = "margin:30px">
                <form method="POST">
                	 <table id="downloadTable">
               	     <tr>
               		  <th>ID</th>
    				  <th>File Name</th>
    				  <th>Uploaded Timestamp</th>
    				  <!-- <th>Uploaded User</th> -->
    				  <th></th>
               	    </tr>
               

               <?php

               	include('connection.php');
               	$val =0; 

                $result = $db->query("SELECT * FROM files");
               
                foreach($result as $row){

  					echo "<tr>";
  					echo "<td>" . $row['fileid'] . "</td>";
  					echo "<td>" . $row['filename'] . "</td>";
  					echo "<td>" . $row['timestamp'] . "</td>";
  					//echo "<td>" . $row['uploadeduser'] . "</td>";
  					// echo "<td> <input  type='button' name='button1' id=".$val." value='Download'> </td>";  
  					echo "<td> <input  type='button' value='Download' onClick=downloadFile('".$row['filename']."') &start=true> </td>";					
  					echo "</tr>";

  					$val++; 
				}

               ?>

               </table>
               <br> 
               <!-- Pagination -->

               <!-- <div class="pagination">
  					<a href="#">&laquo;</a>
  					<a href="#">1</a>
  					<a href="#" class="active">2</a>
  					<a href="#">3</a>
  					<a href="#">4</a>
  					<a href="#">5</a>
  					<a href="#">6</a>
  					<a href="#">&raquo;</a>
			  </div> -->

                </form>
              
               <div style = "font-size:11px; color:#cc0000; margin-top:10px">

                  <?php 
                     echo $error; 
                     $db->close();
                  ?>
                     
               </div>                    
            </div> 
         </div>            
      </div>
      <script>

           function downloadFile(filename){

           	 const fileURL = './uploads/';
           	 const fileName = filename;
           	 const url = fileURL+fileName;

           	 console.log(url);

             //const fileName = '$row['filename']';

             const downloadLink = document.createElement('a');
             downloadLink.href = url;
             downloadLink.download = fileName;
             downloadLink.target = "_blank";

            // Append the link to the DOM (this is required for the download to work in some browsers)
             document.body.appendChild(downloadLink);

            // Click the link to start the download
             downloadLink.click();

           // Remove the link (it's not needed anymore)
            document.body.removeChild(downloadLink);

           }

       </script>
   </body>   
</html>
