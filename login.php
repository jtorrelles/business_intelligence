<?php
   include("app/db/database_conn.php");
   session_start();
   $error = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT userid FROM security WHERE username = '$myusername' and userpassword = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         header("location: app/index.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }

?>
<html>
   
   <head>
      <title>Login Page</title>
      <link href="https://fonts.googleapis.com/css?family=Gudea" rel="stylesheet">
      <style type = "text/css">
         body {
            font-family:"Gudea", sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
	     <p><img src='images/NWPlogo.png'></p><br>
		 <h2>BUSINESS INTELLIGENCE</h2><br>
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#000066; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName:</label><br><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password:</label><br><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
   <?php include 'footer.html';?>
</html>