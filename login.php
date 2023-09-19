<?php
   include("connection.php");

   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT userid, usertype FROM user WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      // $active = $row['active'];
      
      $count = mysqli_num_rows($result);
            
      // If result matched $myusername and $mypassword, table row must be 1 row
        
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         if ($row['usertype'] == "1"){
            header("location: upload.php");
         }else {
            header("location: download.php");
         }        
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<html>
   
   <head>
      <title>Aswesuma Log-In</title>
      <link rel = "stylesheet" type = "text/css" href = "style/style.css">

      <!-- Input filed CSS -->
      <style>
         input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
         }

          input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
         }
      </style>

   </head>
   
   <body bgcolor = "#FFFFFF">  

     <!-- LogIn Form -->

      <div align = "center">
         <br><br>
         <div style = "width:500px; border: solid 1px #333333; background-color:#f2f2f2; border-radius:5px; margin-top:30px" align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:20px;"><b>Aswesuma - LogIn</b></div>                
               <div style = "margin:30px">               
                  <form name="f1" action = "" method = "post" onsubmit = "return validation()">

                     <label>User Name  :</label>
                     <input id = "user" type = "text" name = "username" /><br /><br />

                     <label>Password  :</label>
                     <input id = "pass" type = "password" name = "password"  /><br/><br />

                     <input type = "submit" value = " Submit "/><br />

                  </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px">

                  <?php 
                     echo $error; 
                  ?>
                     
               </div>                    
            </div>               
         </div>            
      </div>

      <!-- End of LogIn Form -->

   <!-- validation for empty field    -->
    <script>  
            function validation()  
            {  
                var id=document.f1.user.value;  
                var ps=document.f1.pass.value;  
                if(id.length=="" && ps.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("User Name is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }  
      </script> 
      <!-- End of Empty Field Validation -->
      
   </body>
</html>